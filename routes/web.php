<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboard;
use App\Http\Controllers\SuperAdmin\ModuleController;
use App\Http\Controllers\IspOwner\DashboardController as IspOwnerDashboard;
use App\Http\Controllers\IspOwner;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Super Admin Routes
Route::prefix('super-admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SuperAdminDashboard::class, 'index'])->name('super-admin.dashboard');
    
    // Module Management
    Route::get('/modules', [ModuleController::class, 'index'])->name('super-admin.modules.index');
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('super-admin.modules.create');
    Route::post('/modules', [ModuleController::class, 'store'])->name('super-admin.modules.store');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('super-admin.modules.show');
    Route::post('/modules/{module}/install', [ModuleController::class, 'install'])->name('super-admin.modules.install');
    Route::post('/modules/{module}/activate', [ModuleController::class, 'activate'])->name('super-admin.modules.activate');
    Route::post('/modules/{module}/deactivate', [ModuleController::class, 'deactivate'])->name('super-admin.modules.deactivate');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('super-admin.modules.destroy');
});

// ISP Owner Routes
Route::prefix('isp-owner')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [IspOwnerDashboard::class, 'index'])->name('isp-owner.dashboard');
    
    // Domain Management
    Route::get('/domains', [IspOwner\DomainController::class, 'index'])->name('isp-owner.domains.index');
    Route::get('/domains/create', [IspOwner\DomainController::class, 'create'])->name('isp-owner.domains.create');
    Route::post('/domains', [IspOwner\DomainController::class, 'store'])->name('isp-owner.domains.store');
    Route::get('/domains/{domain}', [IspOwner\DomainController::class, 'show'])->name('isp-owner.domains.show');
    Route::post('/domains/{domain}/verify', [IspOwner\DomainController::class, 'verify'])->name('isp-owner.domains.verify');
    Route::post('/domains/{domain}/regenerate', [IspOwner\DomainController::class, 'regenerate'])->name('isp-owner.domains.regenerate');
    Route::delete('/domains/{domain}', [IspOwner\DomainController::class, 'destroy'])->name('isp-owner.domains.destroy');
});

// Default dashboard route
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->isSuperAdmin()) {
        return redirect('/super-admin/dashboard');
    } elseif ($user->isIspOwner()) {
        return redirect('/isp-owner/dashboard');
    } elseif ($user->isReseller()) {
        return redirect('/reseller/dashboard');
    } elseif ($user->isSubReseller()) {
        return redirect('/sub-reseller/dashboard');
    } elseif ($user->isStaff()) {
        return redirect('/staff/dashboard');
    }
    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
