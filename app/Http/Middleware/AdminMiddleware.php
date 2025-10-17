<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
• Daftarkan middleware di bootstrap/app.php
6) Mengubah navbar saat sudah Login
/**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request):
(\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
