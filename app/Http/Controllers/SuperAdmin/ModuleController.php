<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ModuleController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        $modules = Module::latest()->paginate(10);
        return view('super-admin.modules.index', compact('modules'));
    }

    public function create()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        return view('super-admin.modules.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'version' => 'required|string|max:50',
            'author' => 'nullable|string|max:255',
            'module_file' => 'required|file|mimes:zip|max:10240', // 10MB max
        ]);

        // Create unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Module::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Store the uploaded file
        $file = $request->file('module_file');
        $fileName = $slug . '_' . time() . '.zip';
        $filePath = $file->storeAs('modules', $fileName, 'local');

        // Extract and validate module
        $extractPath = storage_path('app/modules/extracted/' . $slug);
        $this->extractModule(storage_path('app/' . $filePath), $extractPath);

        // Create module record
        $module = Module::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'version' => $request->version,
            'author' => $request->author,
            'file_path' => $filePath,
            'is_active' => false,
            'is_installed' => false,
            'config' => [],
            'permissions' => $request->permissions ? explode(',', $request->permissions) : [],
        ]);

        return redirect()->route('super-admin.modules.index')
            ->with('success', 'Module uploaded successfully. You can now install and activate it.');
    }

    public function show(Module $module)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        return view('super-admin.modules.show', compact('module'));
    }

    public function install(Module $module)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        try {
            // Mark as installed
            $module->update([
                'is_installed' => true,
                'installed_at' => now(),
            ]);

            return redirect()->route('super-admin.modules.index')
                ->with('success', 'Module installed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('super-admin.modules.index')
                ->with('error', 'Failed to install module: ' . $e->getMessage());
        }
    }

    public function activate(Module $module)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        if (!$module->is_installed) {
            return redirect()->route('super-admin.modules.index')
                ->with('error', 'Module must be installed before activation.');
        }

        $module->update(['is_active' => true]);

        return redirect()->route('super-admin.modules.index')
            ->with('success', 'Module activated successfully.');
    }

    public function deactivate(Module $module)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        $module->update(['is_active' => false]);

        return redirect()->route('super-admin.modules.index')
            ->with('success', 'Module deactivated successfully.');
    }

    public function destroy(Module $module)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied. Super Admin role required.');
        }

        // Delete the module file
        if (Storage::exists($module->file_path)) {
            Storage::delete($module->file_path);
        }

        // Delete extracted files
        $extractPath = storage_path('app/modules/extracted/' . $module->slug);
        if (is_dir($extractPath)) {
            $this->deleteDirectory($extractPath);
        }

        $module->delete();

        return redirect()->route('super-admin.modules.index')
            ->with('success', 'Module deleted successfully.');
    }

    private function extractModule($zipPath, $extractPath)
    {
        $zip = new ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            if (!is_dir($extractPath)) {
                mkdir($extractPath, 0755, true);
            }
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            throw new \Exception('Failed to extract module file.');
        }
    }

    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) return;
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }
}
