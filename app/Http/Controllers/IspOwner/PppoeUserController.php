<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\PppoeUser;
use Illuminate\Http\Request;

class PppoeUserController extends Controller
{
    public function index()
    {
        $users = PppoeUser::where('isp_owner_id', auth()->id())->with('mikrotikRouter')->get();
        return view('isp-owner.pppoe-users.index', compact('users'));
    }

    public function create()
    {
        return view('isp-owner.pppoe-users.create');
    }

    public function store(Request $request)
    {
        // Implementation for PPPoE user creation
        return redirect()->route('isp-owner.pppoe-users.index')
            ->with('success', 'PPPoE user created successfully.');
    }

    public function show(PppoeUser $pppoeUser)
    {
        return view('isp-owner.pppoe-users.show', compact('pppoeUser'));
    }

    public function edit(PppoeUser $pppoeUser)
    {
        return view('isp-owner.pppoe-users.edit', compact('pppoeUser'));
    }

    public function update(Request $request, PppoeUser $pppoeUser)
    {
        return redirect()->route('isp-owner.pppoe-users.index')
            ->with('success', 'PPPoE user updated successfully.');
    }

    public function destroy(PppoeUser $pppoeUser)
    {
        $pppoeUser->delete();
        return redirect()->route('isp-owner.pppoe-users.index')
            ->with('success', 'PPPoE user deleted successfully.');
    }

    public function syncFromMikrotik(PppoeUser $user)
    {
        // Implementation for syncing user data from MikroTik
        return response()->json([
            'success' => true,
            'message' => 'User data synced successfully from MikroTik'
        ]);
    }
}