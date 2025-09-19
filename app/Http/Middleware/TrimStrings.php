<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrimStrings
{
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function handle(Request $request, Closure $next)
    {
        foreach ($request->all() as $key => $value) {
            if (is_string($value) && !in_array($key, $this->except)) {
                $request->merge([$key => trim($value)]);
            }
        }

        return $next($request);
    }
}