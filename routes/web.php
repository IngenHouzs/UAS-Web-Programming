<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\CheckAdmin;

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



// Auth::routes(['verify' => true]);


// Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/test-auth-page', [UserController::class, 'testAuth'])->name('book.testAuth');
    Route::get('/', [UserController::class, 'index'])->name('landing');    
    Route::get('/pinjamanku', [BookLoanController::class, 'viewMyLoans'])->name('pinjamanku');

    Route::post('/collection/{book_id}/{user_id}/request-loan', [BookController::class, 'requestLoan'])->name('requestLoan');
    Route::post('/deleteLoanRequest/{id_peminjaman}', [BookLoanController::class, 'deleteLoanRequest'])->name('deleteLoanRequest');

    // Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
});



// Admin Routes
Route::middleware(['auth', CheckAdmin::class])->group(function(){
    // ADMIN ROUTES (TEMP)
    Route::get('/loans', [BookController::class, 'showAllLoans'])->name('showAllLoans');
    Route::get('/loans/create', [BookController::class, 'createLoanView'])->name('createLoanView');
    Route::get('/pending', [BookController::class, 'showPendingRequests'])->name('showPendingRequests');    

    Route::post('/acceptLoan/{id_peminjaman}/{user_id}/{book_id}', [BookController::class, 'acceptLoan'])->name('acceptLoan');
    Route::post('/rejectLoan/{id_peminjaman}', [BookController::class, 'rejectLoan'])->name('rejectLoan');
    Route::post('/addLoan', [BookLoanController::class, 'addLoan'])->name('addLoan');
    Route::post('/deleteLoan/{id_peminjaman}', [BookLoanController::class, 'deleteLoan'])->name('deleteLoan');
    Route::post('/extendLoan/{id_peminjaman}', [BookLoanController::class, 'extendLoan'])->name('extendLoan');
    Route::post('/deleteBook/{id_buku}', [BookController::class, 'deleteBook'])->name('deleteBook');

    // Passive Routes 
    Route::get('/findstudent', [UserController::class, 'findStudentLS']);
    Route::get('/findbook', [BookController::class, 'findBookLS']);
});


// Route::get('/verify-email', function(){
//     return view('auth.verify-email');
// });


Route::get('/', [UserController::class, 'index'])->name('landing');
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/about', [UserController::class, 'about'])->name('about');
// Route::get('/services', [UserController::class, 'services'])->name('services');
Route::get('/collection', [BookController::class, 'collection'])->name('collection');    
Route::get('/collection/{id}', [BookController::class, 'viewDocument'])->name('viewDocument');




require __DIR__.'/auth.php';






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

