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

Route::get('/', function () {
    return view('welcome');
});
Route::controller(AccountController::class)->group(function () {
    Route::get('/login', 'login')->name('login'); // login page
    Route::post('/login', 'authenticate')->name('auth.login'); // authenticate login account and password 
    Route::get('/register', 'register_page')->name('register'); // register page
    Route::post('/register',  'register')->name('register');  // store register info
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