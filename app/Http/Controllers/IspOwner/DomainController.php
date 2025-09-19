<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\IspDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DomainController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isIspOwner()) {
            abort(403, 'Access denied. ISP Owner role required.');
        }

        $domains = auth()->user()->ispDomains()->latest()->paginate(10);
        return view('isp-owner.domains.index', compact('domains'));
    }

    public function create()
    {
        if (!auth()->user()->isIspOwner()) {
            abort(403, 'Access denied. ISP Owner role required.');
        }

        return view('isp-owner.domains.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isIspOwner()) {
            abort(403, 'Access denied. ISP Owner role required.');
        }

        $request->validate([
            'domain_name' => [
                'required',
                'string',
                'regex:/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i',
                Rule::unique('isp_domains'),
            ],
        ], [
            'domain_name.regex' => 'Please enter a valid domain name (e.g., example.com)',
            'domain_name.unique' => 'This domain is already registered in the system.',
        ]);

        // Generate TXT record value
        $txtRecord = 'isp-saas-verification=' . Str::random(32);

        $domain = auth()->user()->ispDomains()->create([
            'domain_name' => strtolower($request->domain_name),
            'txt_record_value' => $txtRecord,
            'is_verified' => false,
            'is_active' => true,
        ]);

        return redirect()->route('isp-owner.domains.show', $domain)
            ->with('success', 'Domain added successfully. Please add the TXT record to verify ownership.');
    }

    public function show(IspDomain $domain)
    {
        if (!auth()->user()->isIspOwner() || $domain->user_id !== auth()->id()) {
            abort(403, 'Access denied.');
        }

        return view('isp-owner.domains.show', compact('domain'));
    }

    public function verify(IspDomain $domain)
    {
        if (!auth()->user()->isIspOwner() || $domain->user_id !== auth()->id()) {
            abort(403, 'Access denied.');
        }

        if ($domain->is_verified) {
            return redirect()->route('isp-owner.domains.show', $domain)
                ->with('warning', 'Domain is already verified.');
        }

        // Check TXT record
        $txtRecords = $this->getTxtRecords($domain->domain_name);
        $isVerified = false;

        foreach ($txtRecords as $record) {
            if (trim($record) === $domain->txt_record_value) {
                $isVerified = true;
                break;
            }
        }

        if ($isVerified) {
            $domain->update([
                'is_verified' => true,
                'verified_at' => now(),
            ]);

            return redirect()->route('isp-owner.domains.show', $domain)
                ->with('success', 'Domain verified successfully!');
        } else {
            return redirect()->route('isp-owner.domains.show', $domain)
                ->with('error', 'TXT record not found or incorrect. Please check your DNS settings and try again.');
        }
    }

    public function regenerate(IspDomain $domain)
    {
        if (!auth()->user()->isIspOwner() || $domain->user_id !== auth()->id()) {
            abort(403, 'Access denied.');
        }

        if ($domain->is_verified) {
            return redirect()->route('isp-owner.domains.show', $domain)
                ->with('warning', 'Cannot regenerate TXT record for verified domain.');
        }

        // Generate new TXT record
        $txtRecord = 'isp-saas-verification=' . Str::random(32);
        $domain->update([
            'txt_record_value' => $txtRecord,
        ]);

        return redirect()->route('isp-owner.domains.show', $domain)
            ->with('success', 'TXT record regenerated. Please update your DNS settings.');
    }

    public function destroy(IspDomain $domain)
    {
        if (!auth()->user()->isIspOwner() || $domain->user_id !== auth()->id()) {
            abort(403, 'Access denied.');
        }

        $domain->delete();

        return redirect()->route('isp-owner.domains.index')
            ->with('success', 'Domain deleted successfully.');
    }

    private function getTxtRecords($domain)
    {
        try {
            // Get TXT records for the domain
            $records = dns_get_record($domain, DNS_TXT);
            $txtRecords = [];

            if ($records && is_array($records)) {
                foreach ($records as $record) {
                    if (isset($record['txt'])) {
                        $txtRecords[] = $record['txt'];
                    }
                }
            }

            return $txtRecords;
        } catch (\Exception $e) {
            // If DNS lookup fails, return empty array
            return [];
        }
    }
}
