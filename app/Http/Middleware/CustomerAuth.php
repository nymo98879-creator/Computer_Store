<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('customer_logged_in')) {
            return redirect('/')->with('error', 'Please login first.');
        }

        return $next($request);
    }
}
