<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrimStrings
{
    public function handle(Request $request, Closure $next)
    {
        // Trim semua input string (simple)
        $data = $request->all();
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        });
        $request->merge($data);

        return $next($request);
    }
}
