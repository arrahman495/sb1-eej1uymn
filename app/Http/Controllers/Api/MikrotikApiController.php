<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MikrotikApiController extends Controller
{
    public function getRouters()
    {
        return response()->json([
            'message' => 'MikroTik routers API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function testConnection($router)
    {
        return response()->json([
            'message' => 'MikroTik connection test API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function getPppoeUsers($router)
    {
        return response()->json([
            'message' => 'MikroTik PPPoE users API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function createPppoeUser($router, Request $request)
    {
        return response()->json([
            'message' => 'MikroTik create PPPoE user API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function updatePppoeUser($router, $username, Request $request)
    {
        return response()->json([
            'message' => 'MikroTik update PPPoE user API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function deletePppoeUser($router, $username)
    {
        return response()->json([
            'message' => 'MikroTik delete PPPoE user API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function getActiveSessions($router)
    {
        return response()->json([
            'message' => 'MikroTik active sessions API endpoint',
            'status' => 'coming_soon'
        ]);
    }
}