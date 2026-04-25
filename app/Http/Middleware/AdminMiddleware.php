<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Cek apakah role user adalah admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya untuk admin.');
        }

        return $next($request);
    }
}