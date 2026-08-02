<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user()->loadMissing('roles');

        // admins can access everything
        if ($user->hasAnyRole(['admin', 'super_admin'])) {
            return $next($request);
        }

        // Staff can only access orders
        if ($user->isStaff()) {
            $allowedRoutes = [
                'admin.orders.index',
                'admin.orders.show',
                'admin.orders.updateStatus',
            ];

            if (!in_array($request->route()->getName(),
                          $allowedRoutes)) {
                return redirect()->route('admin.orders.index')
                                 ->with('error',
                                   'You only have access to order management.');
            }

            return $next($request);
        }

        return redirect('/')->with('error', 'Access denied.');
    }
}