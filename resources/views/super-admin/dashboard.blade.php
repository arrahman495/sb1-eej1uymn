@extends('layouts.admin')

@section('title', 'Super Admin Dashboard')
@section('page_title', 'Super Admin Dashboard')
@section('dashboard_url', '/super-admin/dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('super-admin.dashboard') }}" class="nav-link active">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>
                User Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Users</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ISP Owners</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles & Permissions</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-puzzle-piece nav-icon"></i>
            <p>
                Module Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Modules</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Upload Module</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-chart-bar nav-icon"></i>
            <p>Reports</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-cogs nav-icon"></i>
            <p>System Settings</p>
        </a>
    </li>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['total_isp_owners'] }}</h3>
                    <p>ISP Owners</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['total_resellers'] }}</h3>
                    <p>Resellers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['total_sub_resellers'] }}</h3>
                    <p>Sub Resellers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- PPPoE Stats -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['total_pppoe_users'] }}</h3>
                    <p>Total PPPoE Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wifi"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['active_pppoe_users'] }}</h3>
                    <p>Active PPPoE Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['online_pppoe_users'] }}</h3>
                    <p>Online PPPoE Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Module Stats -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $stats['total_modules'] }}</h3>
                    <p>Total Modules</p>
                </div>
                <div class="icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['active_modules'] }}</h3>
                    <p>Active Modules</p>
                </div>
                <div class="icon">
                    <i class="fas fa-toggle-on"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Users -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-1"></i>
                        Recent Users
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $user->role->display_name ?? 'No Role' }}</span>
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Modules -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-puzzle-piece mr-1"></i>
                        Recent Modules
                    </h3>
                </div>
                <div class="card-body">
                    @if($recent_modules->count() > 0)
                        @foreach($recent_modules as $module)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong>{{ $module->name }}</strong><br>
                                <small class="text-muted">v{{ $module->version }}</small>
                            </div>
                            <div>
                                @if($module->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted">No modules uploaded yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection