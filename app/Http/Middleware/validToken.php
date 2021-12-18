<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class validToken
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
        $token = $request->header("Authorization");
        $check_token = Token::where('token', $token)->where('expired_at',NULL)->first();
        if($check_token){
            return $next($request);
        }
        return response()->json([
            'error' => 'Invalid Token',
        ]);
    }
}
