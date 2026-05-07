<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;
use App\Models\User;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'access_token' => 'required|string'
        ]);

        try{
            $googleUser = Socialite::driver('googled')->user();

            $user = User::UpdateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]); 

            $token = $user->createToken('nudge-fit-auth-token')->plainTextToken;

        }
    }
}
