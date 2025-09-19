@extends('layouts.admin')

@section('title', 'Module Management')
@section('page_title', 'Module Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Modules</li>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('super-admin.dashboard') }}" class="nav-link">
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
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="fas fa-puzzle-piece nav-icon"></i>
            <p>
                Module Management
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('super-admin.modules.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Modules</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('super-admin.modules.create') }}" class="nav-link">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-puzzle-piece mr-1"></i>
                        All Modules
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('super-admin.modules.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Upload New Module
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($modules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Version</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Installed</th>
                                        <th>Uploaded</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $module)
                                    <tr>
                                        <td>
                                            <strong>{{ $module->name }}</strong>
                                            @if($module->description)
                                                <br><small class="text-muted">{{ Str::limit($module->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">v{{ $module->version }}</span>
                                        </td>
                                        <td>{{ $module->author ?? 'Unknown' }}</td>
                                        <td>
                                            @if($module->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @elseif($module->is_installed)
                                                <span class="badge badge-warning">Installed</span>
                                            @else
                                                <span class="badge badge-secondary">Uploaded</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($module->is_installed)
                                                <i class="fas fa-check text-success"></i>
                                                {{ $module->installed_at ? $module->installed_at->format('M d, Y') : 'Yes' }}
                                            @else
                                                <i class="fas fa-times text-danger"></i> Not Installed
                                            @endif
                                        </td>
                                        <td>{{ $module->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('super-admin.modules.show', $module) }}" 
                                                   class="btn btn-info" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if(!$module->is_installed)
                                                    <form method="POST" action="{{ route('super-admin.modules.install', $module) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" title="Install">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </form>
                                                @elseif(!$module->is_active)
                                                    <form method="POST" action="{{ route('super-admin.modules.activate', $module) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success" title="Activate">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('super-admin.modules.deactivate', $module) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning" title="Deactivate">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form method="POST" action="{{ route('super-admin.modules.destroy', $module) }}" 
                                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this module?')">
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
                        
                        {{ $modules->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-puzzle-piece fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">No Modules Found</h4>
                            <p class="text-muted">Upload your first module to extend the system functionality.</p>
                            <a href="{{ route('super-admin.modules.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Upload First Module
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add confirmation for critical actions
    $('[data-confirm]').click(function(e) {
        if (!confirm($(this).data('confirm'))) {
            e.preventDefault();
        }
    });
});
</script>
@endpush