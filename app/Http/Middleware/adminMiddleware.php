<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $user = auth()->user()->loadMissing('roles');

        if (!$user->hasAnyRole(['admin', 'super_admin', 'staff'])) {
            return redirect('/')
                   ->with('error', 'Access denied.');
        }

        return $next($request);
    }
}