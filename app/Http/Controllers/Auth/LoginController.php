<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            $user->last_login_at = Carbon::now();
            $user->save();

            $request->session()->regenerate();

            // Redirect based on role
            if ($user->isSuperAdmin()) {
                return redirect()->intended('/super-admin/dashboard');
            } elseif ($user->isIspOwner()) {
                return redirect()->intended('/isp-owner/dashboard');
            } elseif ($user->isReseller()) {
                return redirect()->intended('/reseller/dashboard');
            } elseif ($user->isSubReseller()) {
                return redirect()->intended('/sub-reseller/dashboard');
            } elseif ($user->isStaff()) {
                return redirect()->intended('/staff/dashboard');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
