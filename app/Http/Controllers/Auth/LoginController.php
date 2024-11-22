<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create() {
        if (Auth::check()) {
            return redirect('/');
        }

        return Inertia::render('Auth/Login');
    }

    public function store(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    public function destroy(Request $request): RedirectResponse {
        Auth::logout();
        Log::info('Before session destroy: ' . session()->getId());
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('After session destroy: ' . session()->getId());
        
        return redirect('/login');
    }
}
