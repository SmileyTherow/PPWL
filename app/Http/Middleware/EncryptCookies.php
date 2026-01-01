<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EncryptCookies
{
    public function handle(Request $request, Closure $next)
    {
        // Stub minimal: pada produksi gunakan middleware asli Laravel
        return $next($request);
    }
}
