<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventRequestsDuringMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        // Jika ingin implementasi maintenance, bisa ditambahkan.
        return $next($request);
    }
}
