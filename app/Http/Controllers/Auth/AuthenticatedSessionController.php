<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    // login 
    public function create(): View
    {
        return view('auth.login');
    }


    //store method
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $user = auth()-> user()->loadMissing('roles');

        //block account
        if ($user->status == 0) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Your account has been blocked. Please contact the administrator']);
        }

        // redirect admin users. not automatically, it will show message that admin needs to use admin/login
        if ($user->hasAnyRole(['admin', 'super_admin', 'staff'])) {
            auth()->logout();
            return redirect()->back()->withErrors([
                'email' => 'Please use the admin login',
            ]);
        }

        $request->session()->regenerate();
        
        return redirect()->intended('/');
    }


    // logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
