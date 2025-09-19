@extends('layouts.admin')

@section('title', 'Module Details')
@section('page_title', 'Module Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('super-admin.modules.index') }}">Modules</a></li>
    <li class="breadcrumb-item active">{{ $module->name }}</li>
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-puzzle-piece mr-1"></i>
                        {{ $module->name }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('super-admin.modules.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Modules
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Module Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $module->name }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Version:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge badge-info">v{{ $module->version }}</span>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Author:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $module->author ?? 'Unknown' }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-sm-8">
                            @if($module->is_active)
                                <span class="badge badge-success">Active</span>
                            @elseif($module->is_installed)
                                <span class="badge badge-warning">Installed</span>
                            @else
                                <span class="badge badge-secondary">Uploaded</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Installation Status:</strong>
                        </div>
                        <div class="col-sm-8">
                            @if($module->is_installed)
                                <i class="fas fa-check text-success"></i> 
                                Installed 
                                @if($module->installed_at)
                                    on {{ $module->installed_at->format('M d, Y H:i') }}
                                @endif
                            @else
                                <i class="fas fa-times text-danger"></i> Not Installed
                            @endif
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Uploaded:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $module->created_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $module->description ?? 'No description provided' }}
                        </div>
                    </div>
                    
                    @if($module->permissions && count($module->permissions) > 0)
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Permissions:</strong>
                        </div>
                        <div class="col-sm-8">
                            @foreach($module->permissions as $permission)
                                <span class="badge badge-light">{{ $permission }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    @if(!$module->is_installed)
                        <form method="POST" action="{{ route('super-admin.modules.install', $module) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-download"></i> Install Module
                            </button>
                        </form>
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                Module needs to be installed before it can be activated.
                            </small>
                        </div>
                    @elseif(!$module->is_active)
                        <form method="POST" action="{{ route('super-admin.modules.activate', $module) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-play"></i> Activate Module
                            </button>
                        </form>
                        <div class="alert alert-success">
                            <small>
                                <i class="fas fa-check-circle"></i>
                                Module is installed and ready to be activated.
                            </small>
                        </div>
                    @else
                        <form method="POST" action="{{ route('super-admin.modules.deactivate', $module) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-pause"></i> Deactivate Module
                            </button>
                        </form>
                        <div class="alert alert-success">
                            <small>
                                <i class="fas fa-check-circle"></i>
                                Module is active and available to users.
                            </small>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <form method="POST" action="{{ route('super-admin.modules.destroy', $module) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this module? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Module
                        </button>
                    </form>
                    <small class="text-muted">
                        <i class="fas fa-exclamation-triangle"></i>
                        This will permanently delete the module and all its files.
                    </small>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Module Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Slug:</dt>
                        <dd class="col-sm-7">
                            <code>{{ $module->slug }}</code>
                        </dd>
                        
                        <dt class="col-sm-5">File Size:</dt>
                        <dd class="col-sm-7">
                            @if(Storage::exists($module->file_path))
                                {{ number_format(Storage::size($module->file_path) / 1024, 2) }} KB
                            @else
                                <span class="text-danger">File not found</span>
                            @endif
                        </dd>
                        
                        <dt class="col-sm-5">Last Modified:</dt>
                        <dd class="col-sm-7">
                            {{ $module->updated_at->format('M d, Y H:i') }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection