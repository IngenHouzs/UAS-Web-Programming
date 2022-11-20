<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// User routes


Route::controller(UserController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    // testAuth bisa diapus nanti (cuma buat test authentication)
    Route::get('/testauth', 'testAuth')->middleware('auth');

    Route::post('/logout', 'logOut')->middleware('auth');
});

// Login routes
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'showLoginPage')->middleware('guest')->name('login');
    Route::post('/login', 'loginProcess');
});

// Registration routes
Route::controller(RegistrationController::class)->group(function(){
    Route::get('/registration', 'showSignUpPage')->middleware('guest')->name('registration');
    Route::post('/registration', 'createUserProcess');
});

hehehehe;