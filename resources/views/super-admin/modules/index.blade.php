@extends('layouts.app')

@section('title', 'Module Management')
@section('page-title', 'Module Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Modules</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-puzzle-piece mr-1"></i>
                        System Modules
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('super-admin.modules.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Upload New Module
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Version</th>
                                    <th>Status</th>
                                    <th>Dependencies</th>
                                    <th>Uploaded By</th>
                                    <th>Upload Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($modules as $module)
                                    <tr>
                                        <td>
                                            <strong>{{ $module->name }}</strong>
                                            @if($module->description)
                                                <br><small class="text-muted">{{ Str::limit($module->description, 100) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $module->version }}</span>
                                        </td>
                                        <td>
                                            @if($module->is_active)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check"></i> Active
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-pause"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($module->dependencies))
                                                @foreach($module->dependencies as $dependency)
                                                    <span class="badge badge-secondary">{{ $dependency }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                        <td>{{ $module->uploader->name ?? 'Unknown' }}</td>
                                        <td>{{ $module->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('super-admin.modules.show', $module) }}" 
                                                   class="btn btn-sm btn-info" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <a href="{{ route('super-admin.modules.edit', $module) }}" 
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                @if($module->is_active)
                                                    <form action="{{ route('super-admin.modules.deactivate', $module) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-secondary" 
                                                                title="Deactivate"
                                                                onclick="return confirm('Are you sure you want to deactivate this module?')">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('super-admin.modules.activate', $module) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" 
                                                                title="Activate"
                                                                onclick="return confirm('Are you sure you want to activate this module?')">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('super-admin.modules.destroy', $module) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this module? This action cannot be undone.')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-puzzle-piece fa-3x text-muted mb-3"></i>
                                                <h5>No modules uploaded yet</h5>
                                                <p class="text-muted">Upload your first module to extend the functionality of the ISP SaaS.</p>
                                                <a href="{{ route('super-admin.modules.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Upload First Module
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Module Information Modal -->
    <div class="modal fade" id="moduleInfoModal" tabindex="-1" aria-labelledby="moduleInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moduleInfoModalLabel">Module Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> About Modules</h6>
                        <p class="mb-0">
                            Modules extend the functionality of the ISP SaaS system. They can add new features like payment gateways, 
                            billing systems, integration tools, and more. Only Super Admins can upload and manage modules.
                        </p>
                    </div>
                    
                    <h6>Module Requirements:</h6>
                    <ul>
                        <li>Must be in ZIP format</li>
                        <li>Maximum file size: 50MB</li>
                        <li>Should include proper version information</li>
                        <li>Dependencies should be clearly specified</li>
                    </ul>
                    
                    <h6>Module Lifecycle:</h6>
                    <ol>
                        <li><strong>Upload:</strong> Module is uploaded but inactive</li>
                        <li><strong>Activate:</strong> Module becomes available system-wide</li>
                        <li><strong>Update:</strong> Module metadata can be updated</li>
                        <li><strong>Deactivate:</strong> Module is disabled but not deleted</li>
                        <li><strong>Delete:</strong> Module is permanently removed</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('super-admin.modules.create') }}" class="btn btn-primary">Upload Module</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show module info modal if no modules exist
        @if($modules->count() === 0)
            $('#moduleInfoModal').modal('show');
        @endif
        
        // Initialize tooltips
        $('[title]').tooltip();
    });
</script>
@endpush