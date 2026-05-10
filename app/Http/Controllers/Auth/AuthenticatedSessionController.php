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
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Cek apakah user diblokir
        if ($user->is_blocked) {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->back();
        }

        // Redirect berdasarkan role
        if ($user->role == 'admin') {

            return redirect()->intended(route('admin.dashboard.index', absolute: false));
        } elseif ($user->role == 'student') {
            return redirect()->intended(route('student.dashboard.index', absolute: false));
        } elseif ($user->role == 'instructor') {
            return redirect()->intended(route('instructor.dashboard.index', absolute: false));
        }

        // Default redirect
        return redirect('/');
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
