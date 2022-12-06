<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\BookLoan;
use App\Models\User;

class BookController extends Controller
{
    public function collection(Request $request){
        // AuthenticatedSessionController::checkEmailVerification();  

        if ($request->get('string') && $request->get('query')){
            $query = $request->get('query');
            $string = $request->get('string');
            $books = [];
            if ($query === 'judul'){
                $books = Book::where('judul', 'LIKE', '%'.$string.'%')->get();
            } else if ($query === 'penulis'){
                $books = Book::where('authors.nama_penulis', 'LIKE', '%'.$string.'%')
                    ->join('book_authors', 'book_authors.id_buku', '=', 'books.id')
                    ->join('authors', 'authors.id_penulis', '=', 'book_authors.id_penulis')
                    ->get();
            } else if ($query === 'penerbit'){              
                $books = Book::where('publishers.nama_penerbit', 'LIKE', '%'.$string.'%')
                    ->join('publishers', 'publishers.id_penerbit', '=', 'books.id_penerbit')
                    ->get();                
            }
            return view('catalogue', ['books' => $books]);            
        }

        if ($request->get('string')){
            // Automatically search based on title
            $books = Book::where('judul', 'LIKE', '%'.$string.'%')->get();
            return view('catalogue', ['books' => $books]);            
        }



        $books = Book::all();
        return view('catalogue', ['books' => $books]);
    }

    public function viewDocument($id){
        // AuthenticatedSessionController::checkEmailVerification();  

        // Detail Buku
        $document = Book::find($id);

        $findCount = DB::select("
            SELECT COUNT(*) 'terpinjam' FROM book_loans
            WHERE id_buku = ?
            AND tanggal_pengembalian IS NULL
        ", [$id]);

        // Detail Buku yang dipinjam

        $findLoans = DB::select("
            SELECT * FROM book_loans
            WHERE id_buku = ? 
            AND tanggal_pengembalian IS NULL
        ", [$id]);

        $defaultStock = $document->stok;
        $document->stok -= $findCount[0]->terpinjam;

        return view('view-book', ['book' => $document, 'loans' => $findLoans, 'defaultStock' => $defaultStock]);
    }

    public function requestLoan($book_id, $user_id){
        // AuthenticatedSessionController::checkEmailVerification(); 


        // To prevent unneccessary spam, check if user has already requested for the specified book
        // (Cant do double request on the same book)
        // NOTE * : user still cant loan for same books, but can only request one at a time.


        $checkUserLoan = DB::select(
            "SELECT id_peminjaman, id_buku FROM book_loans WHERE 
            id_user = ? AND 
            id_buku = ?
            AND tanggal_pengembalian IS NULL 
            AND tanggal_peminjaman IS NULL 
            AND tenggat_pengembalian IS NULL
            "
        ,[$user_id, $book_id]); 

        if ($checkUserLoan){
            return redirect('/collection/'.$book_id)
                ->with('DOUBLE_REQUEST', 'Maaf, siswa tidak diperbolehkan untuk mengajukan pinjaman lebih dari satu kali
                    pada satu buku yang sama. 
                    Siswa dapat meminjam lebih dari satu buku yang sama, namun tidak boleh melebihi 1 kali pengajuan 
                    (dapat mengajukan lagi apabila request pertama sudah diterima)
                ');
        }

        // Check if user have already loaned more than restriction number (5)

    
        $loan = DB::select(
            "SELECT COUNT(*) 'jumlah' FROM book_loans
                WHERE id_user = ?
                AND tanggal_pengembalian IS NULL
            "
        ,[$user_id]);

        if ($loan[0]->jumlah >= 5){
            return redirect('/collection/'.$book_id)
                ->with('SELF_QUOTA_FULL', 'Batas peminjamanmu sudah habis. Hapus beberapa request, atau segera kembalikan buku untuk dapat meminjam lagi');
        }

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

        // Check if book ran out of stock

        $loaned = DB::select("
            SELECT COUNT(*) 'jumlah' FROM book_loans
            WHERE id_buku = ?
            AND tenggat_pengembalian IS NOT NULL
            AND tanggal_pengembalian IS NULL
        ", [$book_id]);


        if ($book->stok - $loaned[0]->jumlah <= 0){
            return redirect('/pending')
                ->with('UNAVAILABLE', 'Seluruh buku sedang tidak tersedia.');
        }

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

    public function rejectLoan($id_peminjaman){
        BookLoan::where('id_peminjaman', $id_peminjaman)->delete();

        return redirect('/pending');

    }

    public function createLoanView(){
        return view('create-loan');
    }

    public function findBookLS(Request $request){
        $req = $request->query('book');
        $findBook = DB::select('SELECT id, judul FROM books WHERE judul LIKE ?', ['%'.$req.'%']);        
        return $findBook;
    }

    public function deleteBook($id_buku){
        if (Auth::check()){
            if (Auth::user()->role === 1){
                Book::where('id', $id_buku)->delete();
                return redirect('/collection')
                    ->with('DELETE_SUCCESS', 'Berhasil menghapus buku');
            }
        }

        return redirect()->back()
            ->with('DELETE_FAIL', 'Gagal menghapus buku.');
    }


}
