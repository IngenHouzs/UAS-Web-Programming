<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


// Route::middleware(['verified'])->group(function(){
//     Route::get('/', [UserController::class, 'index'])->name('landing');
// });



Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/test-auth-page', [UserController::class, 'testAuth'])->name('book.testAuth');
    Route::get('/', [UserController::class, 'index'])->name('landing');    

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function(){
    return view('auth.verify-email');
});

Route::middleware('guest')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('landing');
});

Route::get('/', [UserController::class, 'index'])->name('landing');



require __DIR__.'/auth.php';






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

