<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect guests to login
        }

        // Check if user role is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Or redirect to home with message
        }

        return $next($request);
    }
}
