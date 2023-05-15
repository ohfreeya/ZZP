<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
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

        // if (Hash::check($value, $hashedValue)) {
        // }

        // validate failed
        return Redirect::to('login')
            ->withErrors(['fail' => 'Email or password is wrong!']);
    }

    //  register page
    public function register_page()
    {
        return view('Account.register');
    }

    //  register account
    public  function register(Request $request)
    {
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
        return view('Account.login')->with('message',['result' => 'success', 'message' => 'Registration successful!']);
    }
}