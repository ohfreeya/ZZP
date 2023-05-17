<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;

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

        $compareField  = ['email' => $googleUser->email];

        $user = $this->accountService->updateOrCreate($compareField, $googleUser);

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
