<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PppoeUser;
use App\Models\MikrotikRouter;

class DashboardController extends Controller
{
    /**
     * Main dashboard - redirects based on user role
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return $this->superAdminDashboard();
        } elseif ($user->isIspOwner()) {
            return $this->ispOwnerDashboard();
        } elseif ($user->isReseller()) {
            return $this->resellerDashboard();
        } elseif ($user->isSubReseller()) {
            return $this->subResellerDashboard();
        } elseif ($user->isStaff()) {
            return $this->staffDashboard();
        }

        return view('dashboard.default');
    }

    /**
     * Super Admin Dashboard
     */
    public function superAdminDashboard()
    {
        $stats = [
            'total_isp_owners' => User::role('isp_owner')->count(),
            'total_resellers' => User::role('reseller')->count(),
            'total_sub_resellers' => User::role('sub_reseller')->count(),
            'total_pppoe_users' => PppoeUser::count(),
            'active_routers' => MikrotikRouter::where('is_active', true)->count(),
            'total_revenue' => PppoeUser::sum('monthly_fee'),
        ];

        $recent_activities = [
            // This will be populated with actual activity logs
        ];

        return view('dashboard.super-admin', compact('stats', 'recent_activities'));
    }

    /**
     * ISP Owner Dashboard
     */
    public function ispOwnerDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total_resellers' => $user->resellers()->count(),
            'total_pppoe_users' => PppoeUser::where('isp_owner_id', $user->id)->count(),
            'active_users' => PppoeUser::where('isp_owner_id', $user->id)->where('is_active', true)->count(),
            'total_routers' => MikrotikRouter::where('isp_owner_id', $user->id)->count(),
            'monthly_revenue' => PppoeUser::where('isp_owner_id', $user->id)->sum('monthly_fee'),
            'online_users' => PppoeUser::where('isp_owner_id', $user->id)->where('status', 'R')->count(),
        ];

        $recent_users = PppoeUser::where('isp_owner_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.isp-owner', compact('stats', 'recent_users'));
    }

    /**
     * Reseller Dashboard
     */
    public function resellerDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total_customers' => PppoeUser::where('reseller_id', $user->id)->count(),
            'active_customers' => PppoeUser::where('reseller_id', $user->id)->where('is_active', true)->count(),
            'sub_resellers' => $user->subResellers()->count(),
            'monthly_revenue' => PppoeUser::where('reseller_id', $user->id)->sum('monthly_fee'),
            'commission_earned' => 0, // Calculate based on commission rate
        ];

        $recent_customers = PppoeUser::where('reseller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.reseller', compact('stats', 'recent_customers'));
    }

    /**
     * Sub Reseller Dashboard
     */
    public function subResellerDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total_customers' => PppoeUser::where('sub_reseller_id', $user->id)->count(),
            'active_customers' => PppoeUser::where('sub_reseller_id', $user->id)->where('is_active', true)->count(),
            'monthly_revenue' => PppoeUser::where('sub_reseller_id', $user->id)->sum('monthly_fee'),
            'commission_earned' => 0, // Calculate based on commission rate
        ];

        $recent_customers = PppoeUser::where('sub_reseller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.sub-reseller', compact('stats', 'recent_customers'));
    }

    /**
     * Staff Dashboard
     */
    public function staffDashboard()
    {
        // Staff will have limited access based on their assigned ISP owner
        $user = Auth::user();
        
        $stats = [
            'assigned_tasks' => 0, // Implement task management
            'completed_tasks' => 0,
            'pending_tickets' => 0, // Implement support ticket system
        ];

        return view('dashboard.staff', compact('stats'));
    }
}