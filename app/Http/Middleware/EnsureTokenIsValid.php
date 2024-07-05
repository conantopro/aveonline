<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {        
        if (Auth::guard('sanctum')->check()) {
            return $next($request);
        }

        return response()->json(['message' => 'Token incorrecto'], 401);
    }
}
