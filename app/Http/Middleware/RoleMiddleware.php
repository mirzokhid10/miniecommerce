<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
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
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if ($request->user()->role !== $role) {
        //     if ($request->user()->role == UserRole::Admin) {
        //         return redirect()->route('admin.dashboard');
        //     } else {
        //         return redirect()->route('user.dashboard');
        //     }
        // }
        // return $next($request);

        $userRole = $request->user()->role;

        // Convert role string (admin/user) into enum:
        $requiredRole = UserRole::from($role);

        if ($userRole !== $requiredRole) {
            return redirect()->route('user.dashboard'); // wrong role → redirect
        }

        return $next($request); // correct role → allow
    }
}
