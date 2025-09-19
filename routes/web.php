<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboard;
use App\Http\Controllers\IspOwner\DashboardController as IspOwnerDashboard;
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
});

// ISP Owner Routes
Route::prefix('isp-owner')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [IspOwnerDashboard::class, 'index'])->name('isp-owner.dashboard');
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
