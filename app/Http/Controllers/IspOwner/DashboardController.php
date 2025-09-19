<?php

namespace App\Http\Controllers\IspOwner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IspDomain;
use App\Models\MikrotikRouter;
use App\Models\Pop;
use App\Models\PppoeUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is ISP owner
        if (!auth()->user()->isIspOwner()) {
            abort(403, 'Access denied. ISP Owner role required.');
        }

        $user = auth()->user();
        
        $stats = [
            'total_domains' => $user->ispDomains()->count(),
            'verified_domains' => $user->ispDomains()->where('is_verified', true)->count(),
            'total_resellers' => $user->children()->whereHas('role', function($q) {
                $q->where('name', 'reseller');
            })->count(),
            'total_mikrotik_routers' => $user->mikrotikRouters()->count(),
            'total_pops' => $user->pops()->count(),
            'total_pppoe_users' => PppoeUser::whereHas('user', function($q) use ($user) {
                $q->where('parent_id', $user->id)->orWhere('id', $user->id);
            })->count(),
            'active_pppoe_users' => PppoeUser::whereHas('user', function($q) use ($user) {
                $q->where('parent_id', $user->id)->orWhere('id', $user->id);
            })->where('is_active', true)->count(),
            'online_pppoe_users' => PppoeUser::whereHas('user', function($q) use ($user) {
                $q->where('parent_id', $user->id)->orWhere('id', $user->id);
            })->where('is_online', true)->count(),
        ];

        $recent_resellers = $user->children()->with('role')->whereHas('role', function($q) {
            $q->where('name', 'reseller');
        })->latest()->limit(5)->get();

        $recent_domains = $user->ispDomains()->latest()->limit(5)->get();

        return view('isp-owner.dashboard', compact('stats', 'recent_resellers', 'recent_domains'));
    }
}
