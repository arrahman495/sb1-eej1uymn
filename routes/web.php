<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\ModuleController;
use App\Http\Controllers\SuperAdmin\IspOwnerController;
use App\Http\Controllers\IspOwner\DomainController;
use App\Http\Controllers\IspOwner\ResellerController;
use App\Http\Controllers\IspOwner\MikrotikController;
use App\Http\Controllers\IspOwner\PppoeUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Super Admin Routes
    Route::middleware('role:super_admin')->prefix('super-admin')->name('super-admin.')->group(function () {
        Route::resource('modules', ModuleController::class);
        Route::post('modules/{module}/activate', [ModuleController::class, 'activate'])->name('modules.activate');
        Route::post('modules/{module}/deactivate', [ModuleController::class, 'deactivate'])->name('modules.deactivate');
        Route::resource('isp-owners', IspOwnerController::class);
    });
    
    // ISP Owner Routes
    Route::middleware('role:isp_owner')->prefix('isp-owner')->name('isp-owner.')->group(function () {
        Route::resource('domains', DomainController::class);
        Route::post('domains/{domain}/verify', [DomainController::class, 'verify'])->name('domains.verify');
        Route::resource('resellers', ResellerController::class);
        Route::resource('mikrotiks', MikrotikController::class);
        Route::post('mikrotiks/{mikrotik}/test-connection', [MikrotikController::class, 'testConnection'])->name('mikrotiks.test-connection');
        Route::resource('pppoe-users', PppoeUserController::class);
        Route::post('pppoe-users/{user}/sync-from-mikrotik', [PppoeUserController::class, 'syncFromMikrotik'])->name('pppoe-users.sync');
    });
    
    // Reseller Routes
    Route::middleware('role:reseller')->prefix('reseller')->name('reseller.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'resellerDashboard'])->name('dashboard');
        // Add reseller specific routes here
    });
    
    // Sub Reseller Routes
    Route::middleware('role:sub_reseller')->prefix('sub-reseller')->name('sub-reseller.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'subResellerDashboard'])->name('dashboard');
        // Add sub reseller specific routes here
    });
    
    // Staff Routes
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'staffDashboard'])->name('dashboard');
        // Add staff specific routes here
    });
});