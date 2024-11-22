<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        //validate information
        $userAttributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user = User::create($userAttributes);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }
}
