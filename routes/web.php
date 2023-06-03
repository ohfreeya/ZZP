<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login', 302);
Route::controller(AccountController::class)->group(function () {
    Route::get('/login', 'login')->name('login'); // login page
    Route::post('/login', 'authenticate')->name('auth.login'); // authenticate login account and password 
    Route::get('/logout', 'logout')->name('logout'); // logout
    Route::get('/register', 'register_page')->name('register'); // register page
    Route::post('/register',  'register')->name('register');  // store register info
    Route::get('/forgot', 'forgotPassword')->name('forgot'); // forgot password page
    Route::post('/verify/email', 'verifyEmail')->name('verify.email'); // verify email and send password reset link
    Route::get('/check', 'checkEmail')->name('check.email'); // notice user to receive reset link in email
    Route::get('/reset/{token}', 'resetPassword')->name('reset'); // reset password page
    Route::post('/reset/{token}', 'storeNewPassword')->name('store.reset'); // reset password page
});
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google'); // google auth
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('auth.google.callback'); // google auth callback
    // Route::get('/auth/facebook', 'redirectToFacebook')->name('auth.facebook'); // facebook
    // Route::get('/auth/facebook/callback', 'handleFacebookCallback')->name('auth.facebook.callback'); // facebook auth callback
});
// after login
Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });
});
