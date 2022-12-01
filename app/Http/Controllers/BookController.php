<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\BookLoan;
use App\Models\User;

class BookController extends Controller
{
    public function collection(){
        // AuthenticatedSessionController::checkEmailVerification();  
        $books = Book::all();
        return view('catalogue', ['books' => $books]);
    }

    public function viewDocument($id){
        // AuthenticatedSessionController::checkEmailVerification();  
        $document = Book::find($id);
        return view('view-book', ['book' => $document]);
    }

    public function requestLoan($book_id, $user_id){
        // AuthenticatedSessionController::checkEmailVerification(); 

        $bookRequest = new BookLoan();
        $bookRequest->id_peminjaman = '';
        $bookRequest->id_buku = $book_id;
        $bookRequest->id_user = $user_id;
        $bookRequest->tanggal_peminjaman = NULL;
        $bookRequest->tenggat_pengembalian = NULL;
        // $bookRequest->tanggal_peminjaman = Carbon::now()->toDateTimeString();
        // $bookRequest->tenggat_pengembalian = Carbon::now()->addDays(7)->toDateTimeString();        
        $bookRequest->save();
    
        return redirect('/collection/'.$book_id)
            ->with('LOAN_SUCCESS', 'Peminjaman berhasil diajukan. Silahkan tunggu konfirmasi Staff Perpustakaan');
    }

    // Nunjukin daftar semua peminjaman (Pivot Table)
    public function showAllLoans(){
        $users = User::with('book')->get()->where('tanggal_peminjaman', !NULL);
        // return $users;
        return view('loanlist', ['users' => $users]);
    }

    public function showPendingRequests(){

        $pendingRequests = User::with('book')->get()->where('tanggal_peminjaman', NULL);
        // return $pendingRequests;
        return view('pending', ['pendingRequests' => $pendingRequests]);
    }


    public function acceptLoan($user_id, $book_id){
        $book = Book::find($book_id);
        $user = User::find($user_id);

        $loan = BookLoan::where('id_buku',$book->id)
            ->where('id_user', $user->id)->update(
                [
                    'tanggal_peminjaman' => Carbon::now()->toDateTimeString(),
                    'tenggat_pengembalian' => Carbon::now()->addDays(7)->toDateTimeString()
                ]
            );
        return redirect('/pending')
            ->with('REQUEST_ACCEPTED', "Peminjaman buku ".$book->judul." oleh ".$user->name." berhasil diterima.");
    }

}
