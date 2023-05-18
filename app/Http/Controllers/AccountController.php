<?php

namespace App\Http\Controllers;

use App\Mail\ResetPWDEmail;
use App\Services\AccountService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     * @param UserRepository $userRepository
     * @return void
     */

    public function __construct(
        private AccountService $accountService
    ) {
        $this->accountService = $accountService;
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

        $user = $this->accountService->create('User', $data);

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
        $user = $this->accountService->getData('user', $request->email);

        if ($user) {
            // generate token
            $token = Str::random(60);
            $token  = Hash::make($token);

            // store the token and expire time
            $this->accountService->create(
                'reset_password',
                [
                    'email' => $request->email,
                    'token' => $token . '',
                    'account_id' => $user->id,
                    'expired_at' => Carbon::now()->addMinute()->format('Y-m-d H:i:s')

                ]
            );

            // prepare parameter to send email
            $data = [
                'reset_token' => $token,
                'reset_link' => 'http://' . config('app.url') . '/reset?token=' . $token
            ];

            // send password reset link by email 
            Mail::to('s1061628@gm.pu.edu.tw')->send(new ResetPWDEmail($data));
        }

        return back()->with('message', ['result' => 'error', 'message' => 'Email not existed!']);
    }

    // reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required'
        ]);

        $user = $this->accountService->getData('token', $request->token);

        if (!$user) {
            return back()->with('message', ['result' => 'error', 'message' => 'Token not found!']);
        }

        // check token isn't expired
        if ($user->expired_at > Carbon::now()->format('Y-m-d H:i:s')) {

            $data = [
                'password' => Hash::make($request->password)
            ];

            $user = $this->accountService->update($user->id, $data);

            if ($user) {
                return back()->with('message', ['result' => 'success', 'message' => 'Password reset successful!']);
            }
        }

        return Redirect::route('forgot')->with('message', ['result' => 'error', 'message' => 'Password reset failed!']);
    }
}