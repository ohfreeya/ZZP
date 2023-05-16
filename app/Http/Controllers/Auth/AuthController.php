<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

        $user = $this->userRepository->googleUpdateOrCreate($googleUser);

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