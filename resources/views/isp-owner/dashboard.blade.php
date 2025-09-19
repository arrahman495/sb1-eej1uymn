@extends('layouts.admin')

@section('title', 'ISP Owner Dashboard')
@section('page_title', 'ISP Owner Dashboard')
@section('dashboard_url', '/isp-owner/dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('isp-owner.dashboard') }}" class="nav-link active">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-globe nav-icon"></i>
            <p>
                Domain Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Domains</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Domain</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-handshake nav-icon"></i>
            <p>
                Reseller Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Resellers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Reseller</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Commission Settings</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-router nav-icon"></i>
            <p>
                Mikrotik Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Routers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Router</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-map-marker-alt nav-icon"></i>
            <p>
                POP Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All POPs</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add POP</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-wifi nav-icon"></i>
            <p>PPPoE Users</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-chart-bar nav-icon"></i>
            <p>Reports</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-dollar-sign nav-icon"></i>
            <p>Billing</p>
        </a>
    </li>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_domains'] }}</h3>
                    <p>Total Domains</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['verified_domains'] }}</h3>
                    <p>Verified Domains</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['total_resellers'] }}</h3>
                    <p>Total Resellers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['total_mikrotik_routers'] }}</h3>
                    <p>Mikrotik Routers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-router"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Infrastructure Stats -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['total_pops'] }}</h3>
                    <p>Total POPs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $stats['total_pppoe_users'] }}</h3>
                    <p>Total PPPoE Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wifi"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- PPPoE User Stats -->
    <div class="row">
        <div class="col-lg-6 col-6">
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
        
        <div class="col-lg-6 col-6">
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

    <div class="row">
        <!-- Recent Resellers -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-handshake mr-1"></i>
                        Recent Resellers
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_resellers as $reseller)
                                <tr>
                                    <td>{{ $reseller->name }}</td>
                                    <td>{{ $reseller->email }}</td>
                                    <td>
                                        @if($reseller->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $reseller->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No resellers found. <a href="#" class="text-primary">Add your first reseller</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Domains -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-globe mr-1"></i>
                        Recent Domains
                    </h3>
                </div>
                <div class="card-body">
                    @forelse($recent_domains as $domain)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $domain->domain_name }}</strong><br>
                            <small class="text-muted">Added {{ $domain->created_at->diffForHumans() }}</small>
                        </div>
                        <div>
                            @if($domain->is_verified)
                                <span class="badge badge-success">Verified</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <i class="fas fa-globe fa-3x mb-3"></i><br>
                        No domains added yet.<br>
                        <a href="#" class="text-primary">Add your first domain</a>
                    </div>
                    @endforelse
                </div>
                @if($recent_domains->count() > 0)
                <div class="card-footer text-center">
                    <a href="#" class="text-primary">View All Domains</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection