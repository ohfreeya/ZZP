<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     * @param UserRepository $userRepository
     * @return void
     */

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    //  login page
    public function login()
    {
        return view('Account.login');
    }

    // login authenticate
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // check user login from username
        $checkFromName =  Auth::attempt(
            [
                'name' => $request->username,
                'password' => $request->password
            ]
        );
        //  check user login from email
        $checkFromEmail =  Auth::attempt(
            [
                'email' => $request->username,
                'password' => $request->password
            ]
        );
        if ($checkFromEmail || $checkFromName) {
            return Redirect::route('home');
        }

        // validate failed
        return Redirect::route('login')->with('message', ['result' => 'error', 'message' => 'Email or password is wrong!']);
    }

    //  register page
    public function register_page()
    {
        return view('Account.register');
    }

    //  register account
    public  function register(Request $request)
    {
        // validate input
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email is invalid.',
                'password.required' => 'Password is required.',
            ]
        );
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = $this->userRepository->create($data);

        if ($user) {
            return Redirect::route('login')->with('message', ['result' => 'success', 'message' => 'Registration successful!']);
        }
        return Redirect::route('register')->with('message', ['result' => 'error', 'message' => 'Registration failed!']);
    }
    //  logout 
    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

    // forgot password page
    public function forgotPassword()
    {
        return view('Account.forgot');
    }

    // verify email and send password reset link
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // check email is existed
        $user = $this->userRepository->findByEmail($request->email);

        // send password reset link by email 
        if ($user) {
        }

        return back()->with('message', ['result' => 'error', 'message' => 'Email not existed!']);
    }
}
