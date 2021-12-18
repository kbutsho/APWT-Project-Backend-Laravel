<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidAdminOrCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('role') == 'admin' || session('role') == 'customer') {
            return $next($request);
        } else{
            return redirect()->route('error');
        }
    }
}
