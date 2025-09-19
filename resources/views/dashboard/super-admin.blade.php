@extends('layouts.app')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">ISP Owners</span>
                    <span class="info-box-number">{{ number_format($stats['total_isp_owners']) }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Resellers</span>
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
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number">${{ number_format($stats['total_revenue'], 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
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
                        <div class="col-6 col-md-4">
                            <a href="{{ route('super-admin.isp-owners.create') }}" class="btn btn-app">
                                <i class="fas fa-plus"></i> Add ISP Owner
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="{{ route('super-admin.modules.index') }}" class="btn btn-app">
                                <i class="fas fa-puzzle-piece"></i> Modules
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="#" class="btn btn-app">
                                <i class="fas fa-chart-line"></i> Reports
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="#" class="btn btn-app">
                                <i class="fas fa-cogs"></i> Settings
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="#" class="btn btn-app">
                                <i class="fas fa-database"></i> Backup
                            </a>
                        </div>
                        <div class="col-6 col-md-4">
                            <a href="#" class="btn btn-app">
                                <i class="fas fa-shield-alt"></i> Security
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
                        System Status
                    </h3>
                </div>
                <div class="card-body">
                    <div class="progress-group">
                        Active Routers
                        <span class="float-right"><b>{{ $stats['active_routers'] }}</b>/{{ $stats['active_routers'] + 5 }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ ($stats['active_routers'] / max($stats['active_routers'] + 5, 1)) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="progress-group">
                        System Load
                        <span class="float-right"><b>65</b>/100</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="progress-group">
                        Database Usage
                        <span class="float-right"><b>45</b>/100</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Recent Activities -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Recent Activities
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="time-label">
                            <span class="bg-danger">Today</span>
                        </div>
                        <div>
                            <i class="fas fa-user bg-info"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 hours ago</span>
                                <h3 class="timeline-header">New ISP Owner registered</h3>
                                <div class="timeline-body">
                                    ISP Owner "TechNet Solutions" has been added to the system.
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-puzzle-piece bg-success"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 5 hours ago</span>
                                <h3 class="timeline-header">Module activated</h3>
                                <div class="timeline-body">
                                    Payment Gateway module v1.2.0 has been activated.
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-chart-line bg-warning"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 1 day ago</span>
                                <h3 class="timeline-header">System maintenance completed</h3>
                                <div class="timeline-body">
                                    Scheduled maintenance for database optimization completed successfully.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Monthly Revenue Trend
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue ($)',
                data: [12000, 19000, 15000, 25000, 22000, 30000],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush