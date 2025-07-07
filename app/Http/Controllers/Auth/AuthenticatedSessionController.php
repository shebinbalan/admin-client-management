<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Enums\UserType;
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
        // Validate & authenticate the login
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

         $user->update([
        'last_login_at' => now(),
    ]);

        // Redirect based on user type
        if ($user->user_type === UserType::ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('client.dashboard');
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


