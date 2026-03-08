<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan role nya user
        if (!auth()->check() || auth()->user()->role !== 'user') {
            return redirect('/admin/dashboard')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}
