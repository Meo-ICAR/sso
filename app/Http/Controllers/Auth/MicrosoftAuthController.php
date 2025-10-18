<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftAuthController extends Controller
{
    /**
     * Redirect the user to the Microsoft authentication page.
     */
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    /**
     * Obtain the user information from Microsoft.
     */
    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();

            // Check if user already exists
            $user = User::where('email', $microsoftUser->getEmail())->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $microsoftUser->getName(),
                    'email' => $microsoftUser->getEmail(),
                    'password' => bcrypt(uniqid()), // Random password as we're using OAuth
                    'microsoft_id' => $microsoftUser->getId(),
                    'email_verified_at' => now(),
                ]);
            } else {
                // Update the Microsoft ID if it's not set
                if (empty($user->microsoft_id)) {
                    $user->microsoft_id = $microsoftUser->getId();
                    $user->save();
                }
            }

            // Log the user in
            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            \Log::error('Microsoft OAuth Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to login with Microsoft. Please try again.');
        }
    }
}
