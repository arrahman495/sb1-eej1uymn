<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IspOwnerController extends Controller
{
    public function index()
    {
        $ispOwners = User::role('isp_owner')->with('createdUsers')->get();
        return view('super-admin.isp-owners.index', compact('ispOwners'));
    }

    public function create()
    {
        return view('super-admin.isp-owners.create');
    }

    public function store(Request $request)
    {
        // Implementation for creating ISP owners
        return redirect()->route('super-admin.isp-owners.index')
            ->with('success', 'ISP Owner created successfully.');
    }

    public function show(User $ispOwner)
    {
        return view('super-admin.isp-owners.show', compact('ispOwner'));
    }

    public function edit(User $ispOwner)
    {
        return view('super-admin.isp-owners.edit', compact('ispOwner'));
    }

    public function update(Request $request, User $ispOwner)
    {
        // Implementation for updating ISP owners
        return redirect()->route('super-admin.isp-owners.index')
            ->with('success', 'ISP Owner updated successfully.');
    }

    public function destroy(User $ispOwner)
    {
        // Implementation for deleting ISP owners
        return redirect()->route('super-admin.isp-owners.index')
            ->with('success', 'ISP Owner deleted successfully.');
    }
}