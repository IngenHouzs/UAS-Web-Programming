<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Models\Book;
use App\Models\Publisher;

class BookController extends Controller
{
    public function collection(){
        AuthenticatedSessionController::checkEmailVerification();  
        $books = Book::all();
        return view('catalogue', ['books' => $books]);
    }
    
}
