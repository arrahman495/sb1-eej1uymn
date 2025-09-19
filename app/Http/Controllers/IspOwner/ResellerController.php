<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function index()
    {
        $resellers = User::role('reseller')->where('isp_owner_id', auth()->id())->get();
        return view('isp-owner.resellers.index', compact('resellers'));
    }

    public function create()
    {
        return view('isp-owner.resellers.create');
    }

    public function store(Request $request)
    {
        // Implementation for reseller creation
        return redirect()->route('isp-owner.resellers.index')
            ->with('success', 'Reseller created successfully.');
    }

    public function show(User $reseller)
    {
        return view('isp-owner.resellers.show', compact('reseller'));
    }

    public function edit(User $reseller)
    {
        return view('isp-owner.resellers.edit', compact('reseller'));
    }

    public function update(Request $request, User $reseller)
    {
        return redirect()->route('isp-owner.resellers.index')
            ->with('success', 'Reseller updated successfully.');
    }

    public function destroy(User $reseller)
    {
        return redirect()->route('isp-owner.resellers.index')
            ->with('success', 'Reseller deleted successfully.');
    }
}