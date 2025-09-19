@extends('layouts.admin')

@section('title', 'Upload Module')
@section('page_title', 'Upload New Module')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('super-admin.modules.index') }}">Modules</a></li>
    <li class="breadcrumb-item active">Upload Module</li>
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
                <a href="{{ route('super-admin.modules.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Modules</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('super-admin.modules.create') }}" class="nav-link active">
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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-1"></i>
                        Upload New Module
                    </h3>
                </div>
                
                <form method="POST" action="{{ route('super-admin.modules.store') }}" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Module Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Version <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('version') is-invalid @enderror" 
                                           id="version" 
                                           name="version" 
                                           value="{{ old('version', '1.0.0') }}" 
                                           placeholder="e.g., 1.0.0"
                                           required>
                                    @error('version')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" 
                                   class="form-control @error('author') is-invalid @enderror" 
                                   id="author" 
                                   name="author" 
                                   value="{{ old('author') }}" 
                                   placeholder="Module author name">
                            @error('author')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Brief description of the module functionality">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="permissions">Permissions (comma-separated)</label>
                            <input type="text" 
                                   class="form-control @error('permissions') is-invalid @enderror" 
                                   id="permissions" 
                                   name="permissions" 
                                   value="{{ old('permissions') }}" 
                                   placeholder="e.g., module_feature_1, module_feature_2">
                            <small class="form-text text-muted">
                                List permissions that this module requires, separated by commas
                            </small>
                            @error('permissions')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="module_file">Module File <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('module_file') is-invalid @enderror" 
                                       id="module_file" 
                                       name="module_file" 
                                       accept=".zip"
                                       required>
                                <label class="custom-file-label" for="module_file">Choose ZIP file...</label>
                            </div>
                            <small class="form-text text-muted">
                                Upload a ZIP file containing your module (max 10MB)
                            </small>
                            @error('module_file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="icon fas fa-info"></i> Module Upload Guidelines:</h5>
                            <ul class="mb-0">
                                <li>Module must be packaged as a ZIP file</li>
                                <li>Maximum file size: 10MB</li>
                                <li>Module will be extracted and validated after upload</li>
                                <li>You can install and activate the module after uploading</li>
                                <li>Active modules will be available to all users based on their roles</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Module
                                </button>
                                <a href="{{ route('super-admin.modules.index') }}" class="btn btn-default ml-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Custom file input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    
    // Form validation
    $('form').on('submit', function(e) {
        let fileInput = $('#module_file')[0];
        if (fileInput.files.length > 0) {
            let fileSize = fileInput.files[0].size / 1024 / 1024; // Convert to MB
            if (fileSize > 10) {
                e.preventDefault();
                alert('File size must be less than 10MB');
                return false;
            }
        }
    });
});
</script>
@endpush