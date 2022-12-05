<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use App\Models\BookLoan;



class BookLoanController extends Controller
{
    //  
    public function addLoan(Request $request){

        $findBook = Book::where('judul', $request->book)->get();
        $findUser = User::where('name', $request->nama)->get();

        $valid = FALSE;

        if (count($findBook) > 0 && count($findUser) > 0){
            $valid = TRUE;
        }
   

        if ($valid){
            $newLoan = new BookLoan;
            $newLoan->id_peminjaman = '';
            $newLoan->id_buku = $findBook[0]->id;
            $newLoan->id_user = $findUser[0]->id;
            $newLoan->tanggal_peminjaman = Carbon::now()->toDateTimeString();
            $newLoan->tenggat_pengembalian = Carbon::now()->addDays(7)->toDateTimeString();                
            $newLoan->save();

            return redirect('/loans')
                ->with('SUCCESS', 'Penambahan pinjaman berhasil!');
        }



        return redirect('/loans')
        ->with('FAIL', 'Data terkait tidak ditemukan');
        
    }


    public function deleteLoan($id_peminjaman){
        $clearLoan = BookLoan::where('id_peminjaman', $id_peminjaman)
            ->update(
                    ['tanggal_pengembalian' =>  Carbon::now()->toDateTimeString()]
                );
        if (!$clearLoan){
            return redirect('/loans')
                ->with('CLEARLOAN_FAIL', 'Pencatatan pada sistem gagal. Silahkan coba lagi');
        }

        return redirect('/loans');
    }


    public function extendLoan($id_peminjaman){
        $findLoan = BookLoan::where('id_peminjaman', $id_peminjaman)->get();
        if (!$findLoan){
            return redirect('/loans')
                ->with('EXTEND_LOAN_FAIL', 'Penambahan durasi pada sistem gagal. Silahkan coba lagi');        
        }

        $currentDeadline = Carbon::parse($findLoan[0]->tenggat_pengembalian);

        $loan = BookLoan::where('id_peminjaman', $id_peminjaman)
            ->update(
                    ['tenggat_pengembalian' =>  $currentDeadline->addDays(3)]
                );
        if (!$loan){
            return redirect('/loans')
                ->with('EXTEND_LOAN_FAIL', 'Penambahan durasi pada sistem gagal. Silahkan coba lagi');
        }

        return redirect('/loans');        
    }


    public function viewMyLoans(){
        
        if (!Auth::check()){
            return view('login');
        }
    
        $loans = DB::select(
            "SELECT book_loans.id_buku id_buku, 
                books.judul judul,
                book_loans.id_peminjaman id_peminjaman,
                book_loans.tanggal_peminjaman tanggal_peminjaman,
                book_loans.tenggat_pengembalian tenggat_pengembalian
                FROM book_loans
                JOIN books ON book_loans.id_buku = books.id
                WHERE book_loans.id_user = ?
                AND book_loans.tanggal_pengembalian IS NULL
            "
        ,[Auth::user()->id]);

        return view('my-loan', ['loans' => $loans]);
    }

    public function deleteLoanRequest($id_peminjaman){
        $loan = BookLoan::where('id_peminjaman', $id_peminjaman)->get();
        if ($loan){
            if (!$loan[0]->tanggal_peminjaman && !$loan[0]->tenggat_pengembalian){
                BookLoan::where('id_peminjaman', $id_peminjaman)->delete();
            }
        }

        return redirect('/pinjamanku');

    }

}
