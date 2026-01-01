<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (! Auth::check()) {
            // jika belum login, redirect ke route login
            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}
