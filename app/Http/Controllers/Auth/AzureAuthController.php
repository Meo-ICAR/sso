<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AzureAuthController extends Controller
{
    public function redirectToAzure()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleAzureCallback()
    {
        try {
            $azureUser = Socialite::driver('microsoft')->user();
            
            $user = User::updateOrCreate(
                ['email' => $azureUser->getEmail()],
                [
                    'name' => $azureUser->getName(),
                    'email' => $azureUser->getEmail(),
                    'password' => encrypt(rand().time()),
                    'azure_id' => $azureUser->getId(),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);
            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login using Azure AD. Please try again.');
        }
    }
}
