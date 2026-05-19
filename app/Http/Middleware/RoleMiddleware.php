<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Jika user tidak login, redirect ke login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Jika user login tapi role tidak sesuai
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Unauthorized. Role tidak sesuai untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
