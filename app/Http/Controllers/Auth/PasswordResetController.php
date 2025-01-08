<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Inertia\Inertia;

class PasswordResetController extends Controller
{
    // Generer reset-token og vis det til brugeren
    public function generateResetToken(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // Generer token
            $token = Str::random(60);

            // Slet gamle tokens
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            // Gem token i databasen som hash
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]);

            // Redirect til en GET-side med token som en parameter
            return redirect()->route('show-token', ['token' => $token, 'email' => $request->email]);
        }


    // Nulstil adgangskode
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Tjek om token eksisterer og matcher
        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        // Opdater brugerens adgangskode
        $user = \App\Models\User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);  // Hash passwordet
        $user->save();

        // Slet reset-token efter brug
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirect til login-siden med en succesbesked
        return redirect('/login');
    }
}
