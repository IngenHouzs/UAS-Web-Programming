<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
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

    Route::post('/collection/{book_id}/{user_id}/request-loan', [BookController::class, 'requestLoan'])->name('requestLoan');

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');

    // ADMIN ROUTES (TEMP)
    Route::get('/loans', [BookController::class, 'showAllLoans'])->name('showAllLoans');



});

Route::get('/verify-email', function(){
    return view('auth.verify-email');
});


Route::get('/', [UserController::class, 'index'])->name('landing');
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/services', [UserController::class, 'services'])->name('services');
Route::get('/collection', [BookController::class, 'collection'])->name('collection');    
Route::get('/collection/{id}', [BookController::class, 'viewDocument'])->name('viewDocument');



require __DIR__.'/auth.php';






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

