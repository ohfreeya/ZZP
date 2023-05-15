<?php

use App\Http\Controllers\AccountController;
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
    Route::get('/login', 'login')->name('login_page'); // login page
    Route::post('/login', 'authenticate')->name('login_auth'); // authenticate login account and password 
    Route::get('/register', 'register_page')->name('register_page'); // register page
    Route::post('/register',  'register')->name('register');  // store register info
});
// after login
Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });
});