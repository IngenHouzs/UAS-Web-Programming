<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function showAllLoans(Request $request){

        if ($request->nama){
            $name = $request->query('nama');
            $loan = DB::select("
            SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                JOIN users ON book_loans.id_user = users.id        
                WHERE book_loans.tanggal_peminjaman IS NOT NULL
                  AND book_loans.tanggal_pengembalian IS NULL
                  AND book_loans.tenggat_pengembalian IS NOT NULL 
                  AND users.name = ?
            ", [$name]);             
            return view('loanlist', ["loans" => $loan]);
        }


        $loans = DB::select("
            SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                JOIN users ON book_loans.id_user = users.id        
                WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                  AND book_loans.tanggal_pengembalian IS NULL
                  AND book_loans.tenggat_pengembalian IS NOT NULL
        "); 
     
        return view("loanlist", ["loans" => $loans]);

    }

    public function showPendingRequests(){
        $requests = DB::select("
            SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id book_id FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                JOIN users ON book_loans.id_user = users.id        
                WHERE book_loans.tanggal_peminjaman IS NULL
                  AND book_loans.tenggat_pengembalian IS NULL
        "); 
        
        return view('pending', ['requests' => $requests]);
    }

    public function acceptLoan($id_peminjaman, $user_id, $book_id){
        
        $book = Book::find($book_id);
        $user = User::find($user_id);

        BookLoan::where('id_peminjaman', $id_peminjaman)
            ->where('id_buku',$book->id)
            ->where('id_user', $user->id)->update(
                [
                    'tanggal_peminjaman' => Carbon::now()->toDateTimeString(),
                    'tenggat_pengembalian' => Carbon::now()->addDays(7)->toDateTimeString()
                ]
            );
        return redirect('/pending')
            ->with('REQUEST_ACCEPTED', "Peminjaman buku ".$book->judul." oleh ".$user->name." berhasil diterima.");
    }

    public function createLoanView(){
        return view('create-loan');
    }

    public function findBookLS(Request $request){
        $req = $request->query('book');
        $findBook = DB::select('SELECT id, judul FROM books WHERE judul LIKE ?', ['%'.$req.'%']);        
        return $findBook;
    }
}
