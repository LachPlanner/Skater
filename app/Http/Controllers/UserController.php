<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Vis brugerens profil.
     */
    public function show()
    {
        $user = Auth::user();

        // Returnér kun nødvendige data
        return Inertia::render('User/Profile', [
            'user' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
            ],
        ]);
    }
}

