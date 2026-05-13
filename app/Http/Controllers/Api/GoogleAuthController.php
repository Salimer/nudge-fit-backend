<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Log;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'access_token' => 'required|string',
        ]);

        try {
            $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->access_token);

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
            ]);

            $token = $user->createToken('nudge-fit-auth-token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            Log::error('Google Auth Error: '.$e->getMessage());

            return response()->json([
                'message' => 'Unauthorized',

            ], status: 401);
        }
    }
}
