<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check() || !auth()-> user() -> isAdmin()){
            return redirect('/')
                    ->with('error','Access denied. Admins only.');
        }

        return $next($request);
    }
}
