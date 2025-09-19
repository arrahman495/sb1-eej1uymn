<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of modules
     */
    public function index()
    {
        $modules = Module::with('uploader')->orderBy('created_at', 'desc')->get();
        return view('super-admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new module
     */
    public function create()
    {
        return view('super-admin.modules.create');
    }

    /**
     * Store a newly created module
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:modules,name',
            'description' => 'nullable|string',
            'version' => 'required|string|max:50',
            'module_file' => 'required|file|mimes:zip|max:51200', // 50MB max
            'dependencies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Store the uploaded file
            $file = $request->file('module_file');
            $filename = Str::slug($request->name) . '_' . time() . '.zip';
            $filePath = $file->storeAs('modules', $filename, 'local');

            // Parse dependencies if provided
            $dependencies = [];
            if ($request->dependencies) {
                $dependencies = array_map('trim', explode(',', $request->dependencies));
            }

            // Create the module
            $module = Module::create([
                'name' => $request->name,
                'description' => $request->description,
                'version' => $request->version,
                'file_path' => $filePath,
                'dependencies' => $dependencies,
                'uploaded_by' => auth()->id(),
                'is_active' => false,
            ]);

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module uploaded successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to upload module: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified module
     */
    public function show(Module $module)
    {
        return view('super-admin.modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified module
     */
    public function edit(Module $module)
    {
        return view('super-admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified module
     */
    public function update(Request $request, Module $module)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:modules,name,' . $module->id,
            'description' => 'nullable|string',
            'version' => 'required|string|max:50',
            'dependencies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Parse dependencies if provided
            $dependencies = [];
            if ($request->dependencies) {
                $dependencies = array_map('trim', explode(',', $request->dependencies));
            }

            // Update the module
            $module->update([
                'name' => $request->name,
                'description' => $request->description,
                'version' => $request->version,
                'dependencies' => $dependencies,
            ]);

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module updated successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update module: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified module
     */
    public function destroy(Module $module)
    {
        try {
            // Delete the file if it exists
            if (Storage::exists($module->file_path)) {
                Storage::delete($module->file_path);
            }

            $module->delete();

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module deleted successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete module: ' . $e->getMessage()]);
        }
    }

    /**
     * Activate a module
     */
    public function activate(Module $module)
    {
        try {
            // Check dependencies before activation
            if (!empty($module->dependencies)) {
                foreach ($module->dependencies as $dependency) {
                    $dependentModule = Module::where('name', $dependency)->where('is_active', true)->first();
                    if (!$dependentModule) {
                        return back()->withErrors(['error' => "Required dependency '{$dependency}' is not active."]);
                    }
                }
            }

            $module->update(['is_active' => true]);

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module activated successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to activate module: ' . $e->getMessage()]);
        }
    }

    /**
     * Deactivate a module
     */
    public function deactivate(Module $module)
    {
        try {
            // Check if other modules depend on this one
            $dependentModules = Module::where('is_active', true)
                ->where('dependencies', 'like', '%' . $module->name . '%')
                ->get();

            if ($dependentModules->count() > 0) {
                $moduleNames = $dependentModules->pluck('name')->implode(', ');
                return back()->withErrors(['error' => "Cannot deactivate module. Other modules depend on it: {$moduleNames}"]);
            }

            $module->update(['is_active' => false]);

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module deactivated successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to deactivate module: ' . $e->getMessage()]);
        }
    }
}