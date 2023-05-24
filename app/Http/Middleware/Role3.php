<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role3
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $role2, $role3): Response
    {
        if (Auth::user()->role == $role || Auth::user()->role == $role2 || Auth::user()->role == $role3) {
            return $next($request);
        }
        return redirect()->back();
    }
}
