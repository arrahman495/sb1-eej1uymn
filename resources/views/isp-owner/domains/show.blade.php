@extends('layouts.admin')

@section('title', 'Domain Details')
@section('page_title', 'Domain Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('isp-owner.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('isp-owner.domains.index') }}">Domains</a></li>
    <li class="breadcrumb-item active">{{ $domain->domain_name }}</li>
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-globe mr-1"></i>
                        {{ $domain->domain_name }}
                        @if($domain->is_verified)
                            <span class="badge badge-success ml-2">
                                <i class="fas fa-check"></i> Verified
                            </span>
                        @else
                            <span class="badge badge-warning ml-2">
                                <i class="fas fa-clock"></i> Pending Verification
                            </span>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('isp-owner.domains.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Domains
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Domain Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $domain->domain_name }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-sm-8">
                            @if($domain->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Verification Status:</strong>
                        </div>
                        <div class="col-sm-8">
                            @if($domain->is_verified)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i> Verified
                                </span>
                                <small class="text-muted ml-2">
                                    Verified on {{ $domain->verified_at->format('M d, Y H:i') }}
                                </small>
                            @else
                                <span class="badge badge-warning">
                                    <i class="fas fa-clock"></i> Pending Verification
                                </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Added:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $domain->created_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                    
                    @if(!$domain->is_verified)
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>TXT Record:</strong>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control" 
                                       value="{{ $domain->txt_record_value }}" 
                                       id="txt-record" 
                                       readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" 
                                            type="button" 
                                            onclick="copyToClipboard('#txt-record')">
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Add this TXT record to your domain's DNS settings
                            </small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @if(!$domain->is_verified)
            <!-- DNS Instructions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs mr-1"></i>
                        DNS Configuration Instructions
                    </h3>
                </div>
                <div class="card-body">
                    <h5>Steps to verify your domain:</h5>
                    <ol>
                        <li>
                            <strong>Access your DNS management panel</strong>
                            <br><small class="text-muted">Log in to your domain registrar or DNS hosting provider</small>
                        </li>
                        <li>
                            <strong>Add a new TXT record</strong>
                            <br><small class="text-muted">Create a new DNS record with the following details:</small>
                            <div class="mt-2 p-3 bg-light border rounded">
                                <table class="table table-sm mb-0">
                                    <tr>
                                        <td><strong>Type:</strong></td>
                                        <td><code>TXT</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name/Host:</strong></td>
                                        <td><code>@</code> or <code>{{ $domain->domain_name }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Value:</strong></td>
                                        <td><code>{{ $domain->txt_record_value }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>TTL:</strong></td>
                                        <td><code>3600</code> (or default)</td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <li>
                            <strong>Save the DNS record</strong>
                            <br><small class="text-muted">Save the changes in your DNS management panel</small>
                        </li>
                        <li>
                            <strong>Wait for DNS propagation</strong>
                            <br><small class="text-muted">DNS changes can take up to 24 hours to propagate globally</small>
                        </li>
                        <li>
                            <strong>Verify the domain</strong>
                            <br><small class="text-muted">Click the "Verify Domain" button once the TXT record is active</small>
                        </li>
                    </ol>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    @if(!$domain->is_verified)
                        <form method="POST" action="{{ route('isp-owner.domains.verify', $domain) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Verify Domain
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('isp-owner.domains.regenerate', $domain) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-sync"></i> Regenerate TXT Record
                            </button>
                        </form>
                        
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                Add the TXT record to your DNS settings, then click "Verify Domain".
                            </small>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h5><i class="fas fa-check-circle"></i> Domain Verified!</h5>
                            <small>
                                Your domain is verified and ready to use for ISP services.
                            </small>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <form method="POST" action="{{ route('isp-owner.domains.destroy', $domain) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this domain? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Domain
                        </button>
                    </form>
                    <small class="text-muted">
                        <i class="fas fa-exclamation-triangle"></i>
                        This will permanently delete the domain from your account.
                    </small>
                </div>
            </div>
            
            @if(!$domain->is_verified)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verification Tools</h3>
                </div>
                <div class="card-body">
                    <p><strong>Check TXT Record Online:</strong></p>
                    <a href="https://toolbox.googleapps.com/apps/dig/#TXT/{{ $domain->domain_name }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm btn-block mb-2">
                        <i class="fas fa-external-link-alt"></i> Google Dig Tool
                    </a>
                    <a href="https://www.whatsmydns.net/#TXT/{{ $domain->domain_name }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm btn-block mb-2">
                        <i class="fas fa-external-link-alt"></i> WhatsMyDNS.net
                    </a>
                    <small class="text-muted">
                        Use these tools to check if your TXT record is propagated.
                    </small>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
function copyToClipboard(element) {
    const copyText = document.querySelector(element);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    // Show feedback
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i> Copied!';
    button.classList.remove('btn-outline-secondary');
    button.classList.add('btn-success');
    
    setTimeout(function() {
        button.innerHTML = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}
</script>
@endpush