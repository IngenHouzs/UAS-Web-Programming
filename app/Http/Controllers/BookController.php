<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\BookLoan;
use App\Models\User;
use App\Models\Author;

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

        $filter = $request->get('filter');
        if ($filter){
            if ($filter === 'asc'){
                $loans = DB::select("
                SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
                book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
                IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'                                
                FROM book_loans
                    JOIN books ON book_loans.id_buku = books.id
                    JOIN users ON book_loans.id_user = users.id        
                    WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                      AND book_loans.tanggal_pengembalian IS NULL
                      AND book_loans.tenggat_pengembalian IS NOT NULL 
                      ORDER BY book_loans.tanggal_peminjaman ASC;
            "); 
         
                return view("loanlist", ["loans" => $loans, 'search' => TRUE]);
            } else if ($filter === 'desc'){
                $loans = DB::select("
                SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
                book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
                IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'                                
                FROM book_loans
                    JOIN books ON book_loans.id_buku = books.id
                    JOIN users ON book_loans.id_user = users.id        
                    WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                      AND book_loans.tanggal_pengembalian IS NULL
                      AND book_loans.tenggat_pengembalian IS NOT NULL 
                      ORDER BY book_loans.tanggal_peminjaman DESC;
            "); 
         
                return view("loanlist", ["loans" => $loans, 'search' => TRUE]);                

            } else if ($filter === 'late'){
                $currentTime =  Carbon::now()->toDateTimeString();
                $loans = DB::select("
                SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
                book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
                IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'                                
                FROM book_loans
                    JOIN books ON book_loans.id_buku = books.id
                    JOIN users ON book_loans.id_user = users.id        
                    WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                      AND book_loans.tanggal_pengembalian IS NULL
                      AND book_loans.tenggat_pengembalian IS NOT NULL
                      AND NOW() > book_loans.tenggat_pengembalian
                ");                 
                 
                return view("loanlist", ["loans" => $loans, 'search' => TRUE]);                      
            } else if ($filter === 'ongoing'){
                $currentTime =  Carbon::now()->toDateTimeString();
                $loans = DB::select("
                SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
                book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
                IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'                                
                FROM book_loans
                    JOIN books ON book_loans.id_buku = books.id
                    JOIN users ON book_loans.id_user = users.id        
                    WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                      AND book_loans.tanggal_pengembalian IS NULL
                      AND book_loans.tenggat_pengembalian IS NOT NULL
                      AND NOW() < book_loans.tenggat_pengembalian
                ");                 
                 
                return view("loanlist", ["loans" => $loans, 'search' => TRUE]);                      
            }
        }


        if ($request->nama){
            $name = $request->query('nama');
            $loan = DB::select("
            SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
            book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
            IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'
            FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                JOIN users ON book_loans.id_user = users.id        
                WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                  AND book_loans.tanggal_pengembalian IS NULL
                  AND book_loans.tenggat_pengembalian IS NOT NULL        
                  AND users.name LIKE ?
            ", ['%'.$name.'%']);             
            
            return view('loanlist', ["loans" => $loan, 'search' => TRUE]);
        }


        $loans = DB::select("
            SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id id_buku,
            book_loans.tanggal_peminjaman tanggal_peminjaman, book_loans.tenggat_pengembalian tenggat_pengembalian,
            IF ((NOW() < book_loans.tenggat_pengembalian), FALSE, TRUE) AS 'late'           
            FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                JOIN users ON book_loans.id_user = users.id        
                WHERE book_loans.tanggal_peminjaman IS NOT NULL 
                  AND book_loans.tanggal_pengembalian IS NULL
                  AND book_loans.tenggat_pengembalian IS NOT NULL
        "); 
     
        return view("loanlist", ["loans" => $loans, 'search' => FALSE]);

    }

    public function showPendingRequests(Request $request){

        if ($request->nama){

            $requests = DB::select("
        SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id book_id,
        (SELECT COUNT(*) FROM book_loans AS bl WHERE bl.id_user = users.id AND NOW() >= bl.tenggat_pengembalian AND bl.tanggal_pengembalian IS NULL) AS 'has_late'            
       FROM book_loans
           JOIN books ON book_loans.id_buku = books.id
           JOIN users ON book_loans.id_user = users.id        
           WHERE book_loans.tanggal_peminjaman IS NULL
             AND book_loans.tenggat_pengembalian IS NULL      
                  AND users.name LIKE ?;
        ", ['%'.$request->nama.'%']);         
            return view('pending', ['requests' => $requests, 'search' => TRUE]);            
        }

        $requests = DB::select("
        SELECT book_loans.id_peminjaman id_peminjaman, users.id nis, users.name nama, books.judul judul, books.id book_id,
        (SELECT COUNT(*) FROM book_loans AS bl WHERE bl.id_user = users.id AND NOW() >= bl.tenggat_pengembalian AND bl.tanggal_pengembalian IS NULL) AS 'has_late'            
       FROM book_loans
           JOIN books ON book_loans.id_buku = books.id
           JOIN users ON book_loans.id_user = users.id        
           WHERE book_loans.tanggal_peminjaman IS NULL
             AND book_loans.tenggat_pengembalian IS NULL
             
        "); 
        
        return view('pending', ['requests' => $requests, 'search' => FALSE]);
    }

    public function acceptLoan($id_peminjaman, $user_id, $book_id, Request $request){
        
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
        if ($request->redirect == 1){
            return redirect('/datasiswa/'.$user_id)
            ->with('REQUEST_ACCEPTED', "Peminjaman buku ".$book->judul." oleh ".$user->name." berhasil diterima.");            
        }

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


    public function addBookView(){
        return view('add-book');
    }

    public function addBook(Request $request){

        $penerbitInput = $request->penerbit;
        $penulisInput = $request->penulis;



        if (is_integer($request->tahun_terbit)){
            return redirect()->back()->with('YEAR_INVALID', 'Tahun terbit tidak valid.');
        } else {
            if ($request->tahun_terbit > Carbon::now()->year || $request->tahun_terbit <= 0){
                return redirect()->back()->with('YEAR_INVALID', 'Tahun terbit tidak valid.');                
            } 
        }

        if (is_integer($request->halaman)){
            return redirect()->back()->with('PAGE_INVALID', 'Format halaman tidak valid.');  
        } else {
            if ($request->halaman <= 0){
                return redirect()->back()->with('PAGE_INVALID', 'Format halaman tidak valid.');                
            }            
        }
   

        $penerbit; // assign ke object nanti
        $penulis; // assign ke object nanti

        $findPublisher = Publisher::where('nama_penerbit', $penerbitInput)->get();

        // Verifikasi Penerbit
        if ($findPublisher && count($findPublisher) > 0){
            $penerbit = $findPublisher[0]->id_penerbit;
        } else {
            $newPenerbit = new Publisher;
            $newPenerbit->id_penerbit = "";
            $newPenerbit->nama_penerbit = $penerbitInput;
            $newPenerbit->save();
            $find = Publisher::where('nama_penerbit', $penerbitInput)->get();
            $penerbit = $find[0]->id_penerbit;
        }

        // Verifikasi Multiple Authors
        $collectAuthor = collect($penulisInput)
                            ->map(function($author){
                            
                    $findAuthor = Author::where('nama_penulis', $author)->get();
                    if ($findAuthor && count($findAuthor) > 0){
                        return $findAuthor[0]->id_penulis;
                    }

                    $newAuthor = new Author;
                    $newAuthor->id_penulis = "";
                    $newAuthor->nama_penulis = $author;
                    $newAuthor->save();
                    
                    $find = Author::where('nama_penulis', $author)->get();
                    return $find[0]->id_penulis;
                            });


        // Masukkan buku ke tabel buku
        $book = new Book;
        $book->id = Str::random(5);
        
        $temp_id = strval($book->id);



        $book->id_penerbit = $penerbit;
        $book->judul = $request->judul;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->tempat_terbit = $request->tempat_terbit;
        try{
            $book->halaman = $request->halaman;
        }catch(Exception $e){
            return redirect()->back()->with('PAGE_INVALID', 'Format halaman tidak valid.');
        }
        $book->ddc = $request->ddc;
        $book->isbn = $request->isbn;
        $book->no_rak = $request->no_rak;

        try{
            $book->save();
        }catch(QueryException $e){
            return redirect()->back()->with('PAGE_INVALID', 'Format halaman tidak valid.');
        }        
        


        // Masukkan seluruh author ke dalam relasi book_author

        $query = "INSERT INTO book_authors VALUES ";

        $ctr = 0;
        $authorList = [];
        foreach($collectAuthor as $author){
            $ctr++;
            if ($ctr === count($collectAuthor)){
                $query .= "(?, '$temp_id');";
            } else {
                $query .= "(?, '$temp_id'),";
            }

            array_push($authorList, $author);
        }    
   

        $insert = DB::insert($query, $authorList);
        if ($insert){
            return redirect('/collection');
        }
        
    }


    public function editBookView($id_buku){
        $book = Book::where('id', $id_buku)->get();
        $loans = BookLoan::where('id_buku', $id_buku)
                    ->where('tanggal_pengembalian', NULL)
                    ->get();



        return view('edit-book', ['book' => $book[0], 'loans' => $loans]);
    }


    public function editBook($id_buku,Request $request){
        Book::where('id', $id_buku)->update(
            ['no_rak' => $request->no_rak,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok
            ]
        );

        return redirect('/collection/'.$id_buku)->with('EDIT_SUCCESS', 'Perubahan pada buku berhasil disimpan');
    }

}
