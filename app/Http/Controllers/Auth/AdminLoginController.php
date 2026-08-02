<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    //admin login form
    public function create(): View
    {
        return view('auth.admin-login');
    }

    // Handle admin login
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user()->loadMissing('roles');

        // staff form using this login page
        if (!$user->hasAnyRole(['admin', 'super_admin', 'staff'])) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'This login is for admin and staff only.',
            ])->onlyInput('email');
        }

        // blovked account
        if ($user->status == 0) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your account has been blocked.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    // Logout 
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}