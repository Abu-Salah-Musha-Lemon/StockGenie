<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $authRole = Auth::user()->role; // Access role as a property
    
        if ($authRole === 0 ) {
            return redirect()->intended(route('admin.dashboard'));  // Redirect to the same dashboard for both roles
        } elseif ( $authRole === 1) {
            return redirect()->intended(route('employee.dashboard'));  // Redirect to the same dashboard for both roles
            # code...
        } else{
            // If the user has an undefined role, redirect them back to the login page or show an error
            return redirect()->route('login')->withErrors('Unauthorized access.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
