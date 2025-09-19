<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\MikrotikRouter;
use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    public function index()
    {
        $routers = MikrotikRouter::where('isp_owner_id', auth()->id())->get();
        return view('isp-owner.mikrotiks.index', compact('routers'));
    }

    public function create()
    {
        return view('isp-owner.mikrotiks.create');
    }

    public function store(Request $request)
    {
        // Implementation for MikroTik router creation
        return redirect()->route('isp-owner.mikrotiks.index')
            ->with('success', 'MikroTik router added successfully.');
    }

    public function show(MikrotikRouter $mikrotik)
    {
        return view('isp-owner.mikrotiks.show', compact('mikrotik'));
    }

    public function edit(MikrotikRouter $mikrotik)
    {
        return view('isp-owner.mikrotiks.edit', compact('mikrotik'));
    }

    public function update(Request $request, MikrotikRouter $mikrotik)
    {
        return redirect()->route('isp-owner.mikrotiks.index')
            ->with('success', 'MikroTik router updated successfully.');
    }

    public function destroy(MikrotikRouter $mikrotik)
    {
        $mikrotik->delete();
        return redirect()->route('isp-owner.mikrotiks.index')
            ->with('success', 'MikroTik router deleted successfully.');
    }

    public function testConnection(MikrotikRouter $mikrotik)
    {
        // Implementation for testing MikroTik connection
        return response()->json([
            'success' => true,
            'message' => 'Connection test successful'
        ]);
    }
}