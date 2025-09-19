@extends('layouts.app')

@section('title', 'Upload Module')
@section('page-title', 'Upload New Module')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('super-admin.modules.index') }}">Modules</a></li>
    <li class="breadcrumb-item active">Upload</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-1"></i>
                        Upload New Module
                    </h3>
                </div>
                <form action="{{ route('super-admin.modules.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Module Requirements</h6>
                            <ul class="mb-0">
                                <li>Module must be in ZIP format (max 50MB)</li>
                                <li>Include proper version information</li>
                                <li>Specify dependencies if any</li>
                                <li>Ensure module is compatible with the current system</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Module Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="e.g., Payment Gateway Integration"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="version">Version <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="version" 
                                   id="version" 
                                   class="form-control @error('version') is-invalid @enderror" 
                                   value="{{ old('version') }}" 
                                   placeholder="e.g., 1.0.0"
                                   required>
                            @error('version')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Brief description of what this module does...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dependencies">Dependencies</label>
                            <input type="text" 
                                   name="dependencies" 
                                   id="dependencies" 
                                   class="form-control @error('dependencies') is-invalid @enderror" 
                                   value="{{ old('dependencies') }}" 
                                   placeholder="e.g., core-billing, user-management (comma-separated)">
                            <small class="form-text text-muted">
                                List other modules this module depends on, separated by commas. Leave empty if no dependencies.
                            </small>
                            @error('dependencies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="module_file">Module File <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       name="module_file" 
                                       id="module_file" 
                                       class="custom-file-input @error('module_file') is-invalid @enderror" 
                                       accept=".zip"
                                       required>
                                <label class="custom-file-label" for="module_file">Choose ZIP file...</label>
                            </div>
                            <small class="form-text text-muted">
                                Maximum file size: 50MB. Only ZIP files are allowed.
                            </small>
                            @error('module_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Module
                        </button>
                        <a href="{{ route('super-admin.modules.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Update file input label when file is selected
    document.getElementById('module_file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Choose ZIP file...';
        const label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('module_file');
        const file = fileInput.files[0];
        
        if (file) {
            // Check file size (50MB = 52428800 bytes)
            if (file.size > 52428800) {
                e.preventDefault();
                alert('File size must be less than 50MB');
                return false;
            }
            
            // Check file type
            if (!file.name.toLowerCase().endsWith('.zip')) {
                e.preventDefault();
                alert('Only ZIP files are allowed');
                return false;
            }
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Uploading...';
    });
</script>
@endpush