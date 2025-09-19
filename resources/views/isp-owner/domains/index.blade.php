@extends('layouts.admin')

@section('title', 'Domain Management')
@section('page_title', 'Domain Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('isp-owner.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Domains</li>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('isp-owner.dashboard') }}" class="nav-link">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="fas fa-globe nav-icon"></i>
            <p>
                Domain Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('isp-owner.domains.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Domains</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('isp-owner.domains.create') }}" class="nav-link">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-globe mr-1"></i>
                        My Domains
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('isp-owner.domains.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Domain
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($domains->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Domain Name</th>
                                        <th>Status</th>
                                        <th>Verification</th>
                                        <th>Added</th>
                                        <th>Verified</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($domains as $domain)
                                    <tr>
                                        <td>
                                            <strong>{{ $domain->domain_name }}</strong>
                                            @if($domain->is_verified)
                                                <i class="fas fa-check-circle text-success ml-1" title="Verified"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($domain->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($domain->is_verified)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check"></i> Verified
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $domain->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($domain->verified_at)
                                                {{ $domain->verified_at->format('M d, Y H:i') }}
                                            @else
                                                <span class="text-muted">Not verified</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('isp-owner.domains.show', $domain) }}" 
                                                   class="btn btn-info" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if(!$domain->is_verified)
                                                    <form method="POST" action="{{ route('isp-owner.domains.verify', $domain) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success" title="Verify Domain">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form method="POST" action="{{ route('isp-owner.domains.destroy', $domain) }}" 
                                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this domain?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $domains->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-globe fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">No Domains Found</h4>
                            <p class="text-muted">Add your first domain to start managing your ISP infrastructure.</p>
                            <a href="{{ route('isp-owner.domains.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Domain
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($domains->count() > 0)
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-1"></i>
                        Domain Verification Guide
                    </h3>
                </div>
                <div class="card-body">
                    <ol>
                        <li><strong>Add Domain:</strong> Click "Add New Domain" and enter your domain name</li>
                        <li><strong>Get TXT Record:</strong> View domain details to get the verification TXT record</li>
                        <li><strong>Configure DNS:</strong> Add the TXT record to your domain's DNS settings</li>
                        <li><strong>Verify:</strong> Click "Verify Domain" to check the TXT record</li>
                        <li><strong>Success:</strong> Once verified, you can use the domain for your ISP services</li>
                    </ol>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Important Notes
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>DNS changes may take up to 24 hours to propagate</li>
                        <li>Only verified domains can be used for ISP services</li>
                        <li>You must have administrative access to your domain's DNS</li>
                        <li>TXT records can be regenerated if needed</li>
                        <li>Each domain can only be registered once in the system</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection