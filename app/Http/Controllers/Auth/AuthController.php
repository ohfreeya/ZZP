<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Str;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(
        private AccountService $accountService
    ) {
        $this->accountService  = $accountService;
    }

    // google auth page redirect
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // handel google callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = $this->accountService->getData('user', 'email', $googleUser->getEmail(), 'first');

        if(!$user){
            $data = [
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => 'google-' . Str::random(8),
                'password' => Hash::make(Str::random(8))
            ];
            $compareField  = ['email' => $googleUser->email];
            $user = $this->accountService->updateOrCreate($compareField, $data);
        }

        Auth::login($user, true);

        return redirect(Route('home'));
    }

    // facebook auth page redirect
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // // handel facebook callback
    // public function handleFacebookCallback()
    // {
    //     $facebookUser = Socialite::driver('facebook')->userFromtoken("");

    //     $user = $this->userRepository->facebookUpdateOrCreate($facebookUser);

    //     Auth::login($user, true);

    //     return redirect(Route('home'));
    // }
}