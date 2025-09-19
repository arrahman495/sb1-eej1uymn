<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MikrotikApiController;
use App\Http\Controllers\Api\PppoeApiController;
use App\Http\Controllers\Api\CustomerApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API Routes (for customer panel, etc.)
Route::prefix('v1')->group(function () {
    
    // Customer Authentication and Management
    Route::prefix('customer')->group(function () {
        Route::post('login', [CustomerApiController::class, 'login']);
        Route::post('register', [CustomerApiController::class, 'register']);
        
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('profile', [CustomerApiController::class, 'profile']);
            Route::put('profile', [CustomerApiController::class, 'updateProfile']);
            Route::get('usage', [CustomerApiController::class, 'usage']);
            Route::get('billing', [CustomerApiController::class, 'billing']);
            Route::post('logout', [CustomerApiController::class, 'logout']);
        });
    });
    
    // Protected API Routes
    Route::middleware('auth:sanctum')->group(function () {
        
        // MikroTik API Management
        Route::prefix('mikrotik')->group(function () {
            Route::get('routers', [MikrotikApiController::class, 'getRouters']);
            Route::post('routers/{router}/test', [MikrotikApiController::class, 'testConnection']);
            Route::get('routers/{router}/pppoe-users', [MikrotikApiController::class, 'getPppoeUsers']);
            Route::post('routers/{router}/pppoe-users', [MikrotikApiController::class, 'createPppoeUser']);
            Route::put('routers/{router}/pppoe-users/{username}', [MikrotikApiController::class, 'updatePppoeUser']);
            Route::delete('routers/{router}/pppoe-users/{username}', [MikrotikApiController::class, 'deletePppoeUser']);
            Route::get('routers/{router}/active-sessions', [MikrotikApiController::class, 'getActiveSessions']);
        });
        
        // PPPoE User Management API
        Route::prefix('pppoe')->group(function () {
            Route::get('users', [PppoeApiController::class, 'index']);
            Route::post('users', [PppoeApiController::class, 'store']);
            Route::get('users/{user}', [PppoeApiController::class, 'show']);
            Route::put('users/{user}', [PppoeApiController::class, 'update']);
            Route::delete('users/{user}', [PppoeApiController::class, 'destroy']);
            Route::post('users/{user}/activate', [PppoeApiController::class, 'activate']);
            Route::post('users/{user}/deactivate', [PppoeApiController::class, 'deactivate']);
            Route::get('users/{user}/usage', [PppoeApiController::class, 'getUsage']);
        });
        
        // OLT Management API
        Route::prefix('olt')->group(function () {
            Route::get('devices', function () {
                return response()->json(['message' => 'OLT API endpoints will be implemented']);
            });
        });
        
        // Billing API
        Route::prefix('billing')->group(function () {
            Route::get('invoices', function () {
                return response()->json(['message' => 'Billing API endpoints will be implemented']);
            });
        });
    });
});