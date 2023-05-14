<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login()
    {
        return view('Account.login');
    }

    public function register()
    {
        return view('Account.register');
    }
}
