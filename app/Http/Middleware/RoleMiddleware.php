<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // cek login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // cek role (support multi role)
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'AKSES DITOLAK');
        }

        return $next($request);
    }
}