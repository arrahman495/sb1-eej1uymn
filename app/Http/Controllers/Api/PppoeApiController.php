<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PppoeApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'PPPoE users list API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'PPPoE user creation API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function show($user)
    {
        return response()->json([
            'message' => 'PPPoE user details API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function update($user, Request $request)
    {
        return response()->json([
            'message' => 'PPPoE user update API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function destroy($user)
    {
        return response()->json([
            'message' => 'PPPoE user deletion API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function activate($user)
    {
        return response()->json([
            'message' => 'PPPoE user activation API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function deactivate($user)
    {
        return response()->json([
            'message' => 'PPPoE user deactivation API endpoint',
            'status' => 'coming_soon'
        ]);
    }

    public function getUsage($user)
    {
        return response()->json([
            'message' => 'PPPoE user usage API endpoint',
            'status' => 'coming_soon'
        ]);
    }
}