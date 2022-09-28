<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => false,
                'message' => 'No token provided',
            ], 403);
        }

        if (auth('sanctum')->user() == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token provided',
            ], 403);
        }

        return $next($request);
    }
}
