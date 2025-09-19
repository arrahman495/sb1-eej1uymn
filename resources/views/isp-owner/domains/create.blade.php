@extends('layouts.admin')

@section('title', 'Add Domain')
@section('page_title', 'Add New Domain')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('isp-owner.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('isp-owner.domains.index') }}">Domains</a></li>
    <li class="breadcrumb-item active">Add Domain</li>
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
                <a href="{{ route('isp-owner.domains.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Domains</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('isp-owner.domains.create') }}" class="nav-link active">
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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus mr-1"></i>
                        Add New Domain
                    </h3>
                </div>
                
                <form method="POST" action="{{ route('isp-owner.domains.store') }}">
                    @csrf
                    
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5><i class="icon fas fa-ban"></i> Validation Error!</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="domain_name">Domain Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                </div>
                                <input type="text" 
                                       class="form-control @error('domain_name') is-invalid @enderror" 
                                       id="domain_name" 
                                       name="domain_name" 
                                       value="{{ old('domain_name') }}" 
                                       placeholder="example.com"
                                       required>
                            </div>
                            @error('domain_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">
                                Enter your domain name without www. (e.g., example.com)
                            </small>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="icon fas fa-info"></i> What happens next?</h5>
                            <ol class="mb-0">
                                <li>After adding your domain, you'll receive a unique TXT record</li>
                                <li>Add this TXT record to your domain's DNS settings</li>
                                <li>Click "Verify Domain" to confirm ownership</li>
                                <li>Once verified, you can use the domain for your ISP services</li>
                            </ol>
                        </div>

                        <div class="alert alert-warning">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Requirements:</h5>
                            <ul class="mb-0">
                                <li>You must have administrative access to the domain's DNS settings</li>
                                <li>The domain must be active and publicly accessible</li>
                                <li>Each domain can only be registered once in the system</li>
                                <li>DNS changes may take up to 24 hours to propagate</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Domain
                                </button>
                                <a href="{{ route('isp-owner.domains.index') }}" class="btn btn-default ml-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Domain Examples -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-secondary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-question-circle mr-1"></i>
                        Domain Format Examples
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success">✓ Valid Formats:</h5>
                            <ul class="list-unstyled">
                                <li><code>example.com</code></li>
                                <li><code>myisp.net</code></li>
                                <li><code>sub.domain.org</code></li>
                                <li><code>my-company.co.uk</code></li>
                                <li><code>test123.info</code></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-danger">✗ Invalid Formats:</h5>
                            <ul class="list-unstyled">
                                <li><code>www.example.com</code> (remove www)</li>
                                <li><code>http://example.com</code> (remove protocol)</li>
                                <li><code>example</code> (missing TLD)</li>
                                <li><code>example.com/path</code> (remove path)</li>
                                <li><code>192.168.1.1</code> (IP addresses not allowed)</li>
                            </ul>
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
    // Auto-format domain name
    $('#domain_name').on('input', function() {
        let value = $(this).val().toLowerCase().trim();
        
        // Remove common prefixes
        value = value.replace(/^(https?:\/\/)?(www\.)?/, '');
        
        // Remove trailing slashes and paths
        value = value.split('/')[0];
        
        $(this).val(value);
    });
    
    // Form validation
    $('form').on('submit', function(e) {
        let domain = $('#domain_name').val();
        
        // Basic domain validation
        let domainRegex = /^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i;
        
        if (!domainRegex.test(domain)) {
            e.preventDefault();
            alert('Please enter a valid domain name (e.g., example.com)');
            $('#domain_name').focus();
            return false;
        }
    });
});
</script>
@endpush