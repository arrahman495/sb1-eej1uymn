<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\PppoeUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is super admin
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        $stats = [
            'total_users' => User::count(),
            'total_isp_owners' => User::whereHas('role', function($q) {
                $q->where('name', 'isp_owner');
            })->count(),
            'total_resellers' => User::whereHas('role', function($q) {
                $q->where('name', 'reseller');
            })->count(),
            'total_sub_resellers' => User::whereHas('role', function($q) {
                $q->where('name', 'sub_reseller');
            })->count(),
            'total_pppoe_users' => PppoeUser::count(),
            'active_pppoe_users' => PppoeUser::where('is_active', true)->count(),
            'online_pppoe_users' => PppoeUser::where('is_online', true)->count(),
            'total_modules' => Module::count(),
            'active_modules' => Module::where('is_active', true)->count(),
        ];

        $recent_users = User::with('role')->latest()->limit(10)->get();
        $recent_modules = Module::latest()->limit(5)->get();

        return view('super-admin.dashboard', compact('stats', 'recent_users', 'recent_modules'));
    }
}
