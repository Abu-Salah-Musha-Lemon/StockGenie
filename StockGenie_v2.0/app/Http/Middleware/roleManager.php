<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class roleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authRole = Auth::user()->role; // Assuming role is an integer

        // Check if the authenticated user's role matches the required role
        switch ($role) {
            case 'admin':
                if ($authRole == 0) {
                    return $next($request);
                }
                break;
            case 'employee':
                if ($authRole == 1) {
                    return $next($request);
                }
                break;
        }

        switch ($authRole) {
            case 0: // admin
                return redirect()->route('admin.dashboard'); // Updated
            case 1: // employee
                return redirect()->route('employee.dashboard'); // Ensure this route exists as well
            default:
                return redirect()->route('login');
        }
    }
}
