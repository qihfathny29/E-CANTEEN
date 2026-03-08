<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan role nya admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}
