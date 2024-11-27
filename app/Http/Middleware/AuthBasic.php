<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthBasic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';

        $validUsers = [
            'username' => 'password123',
            'password' => 'secretpass',
        ];

        if ($username != env('USERNAME_API') && $password != env('PASSWORD_API')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Acceso denegado'
            ], 401);
        }

        return $next($request);
    }
}
