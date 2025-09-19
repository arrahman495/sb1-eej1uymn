<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::where('isp_owner_id', auth()->id())->get();
        return view('isp-owner.domains.index', compact('domains'));
    }

    public function create()
    {
        return view('isp-owner.domains.create');
    }

    public function store(Request $request)
    {
        // Implementation for domain creation and TXT record verification
        return redirect()->route('isp-owner.domains.index')
            ->with('success', 'Domain added successfully.');
    }

    public function show(Domain $domain)
    {
        return view('isp-owner.domains.show', compact('domain'));
    }

    public function edit(Domain $domain)
    {
        return view('isp-owner.domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain)
    {
        // Implementation for domain updates
        return redirect()->route('isp-owner.domains.index')
            ->with('success', 'Domain updated successfully.');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('isp-owner.domains.index')
            ->with('success', 'Domain deleted successfully.');
    }

    public function verify(Domain $domain)
    {
        // Implementation for TXT record verification
        return back()->with('success', 'Domain verification initiated.');
    }
}