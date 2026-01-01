<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCsrfToken
{
    public function handle(Request $request, Closure $next)
    {
        // Stub minimal: tidak memverifikasi token CSRF.
        // WARNING: ini mengurangi keamanan; hanya untuk dev / hilangkan warning Intelephense.
        return $next($request);
    }
}
