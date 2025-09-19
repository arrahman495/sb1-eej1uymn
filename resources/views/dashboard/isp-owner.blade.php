@extends('layouts.app')

@section('title', 'ISP Owner Dashboard')
@section('page-title', 'ISP Owner Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Resellers</span>
                    <span class="info-box-number">{{ number_format($stats['total_resellers']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-friends"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">PPPoE Users</span>
                    <span class="info-box-number">{{ number_format($stats['total_pppoe_users']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wifi"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Online Users</span>
                    <span class="info-box-number">{{ number_format($stats['online_users']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Monthly Revenue</span>
                    <span class="info-box-number">${{ number_format($stats['monthly_revenue'], 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Recent PPPoE Users -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-friends mr-1"></i>
                        Recent PPPoE Users
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('isp-owner.pppoe-users.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New User
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Monthly Fee</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->customer_name }}</td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($user->monthly_fee, 2) }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('isp-owner.pppoe-users.show', $user) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('isp-owner.pppoe-users.edit', $user) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No PPPoE users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt mr-1"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('isp-owner.resellers.create') }}" class="btn btn-app">
                                <i class="fas fa-user-plus"></i> Add Reseller
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('isp-owner.mikrotiks.create') }}" class="btn btn-app">
                                <i class="fas fa-router"></i> Add Router
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('isp-owner.domains.create') }}" class="btn btn-app">
                                <i class="fas fa-globe"></i> Add Domain
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('isp-owner.pppoe-users.create') }}" class="btn btn-app">
                                <i class="fas fa-user-friends"></i> Add User
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-server mr-1"></i>
                        Network Status
                    </h3>
                </div>
                <div class="card-body">
                    <div class="progress-group">
                        Active Routers
                        <span class="float-right"><b>{{ $stats['total_routers'] }}</b>/{{ $stats['total_routers'] + 2 }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ $stats['total_routers'] > 0 ? 85 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="progress-group">
                        User Utilization
                        <span class="float-right"><b>{{ $stats['active_users'] }}</b>/{{ $stats['total_pppoe_users'] }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: {{ $stats['total_pppoe_users'] > 0 ? ($stats['active_users'] / $stats['total_pppoe_users']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="progress-group">
                        Revenue Target
                        <span class="float-right"><b>${{ number_format($stats['monthly_revenue']) }}</b>/$50,000</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: {{ ($stats['monthly_revenue'] / 50000) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto-refresh online users count every 30 seconds
        setInterval(function() {
            // AJAX call to update online users count
            // Implementation will be added with MikroTik integration
        }, 30000);
    });
</script>
@endpush