<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\BookLoan;
use App\Models\User;
use App\Models\Author;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

class UserController extends Controller
{
    public function index(){
        // AuthenticatedSessionController::checkEmailVerification();        
        $hasLate = FALSE;
        if (Auth::check()){
            if (Auth::user()->role === 2){
                $findLate = DB::select(
                    "SELECT COUNT(*) AS 'count' FROM book_loans
                    WHERE book_loans.id_user = ?
                    AND tanggal_pengembalian IS NULL  
                    AND NOW() >= book_loans.tenggat_pengembalian
                    "
                ,[Auth::user()->id]);               
                if ($findLate[0]->count){
                    $hasLate = TRUE;
                }
            }
        }        
        return view('landing', ['late' => $hasLate]);  
    }

    public function home(){
        // AuthenticatedSessionController::checkEmailVerification();        
        $hasLate = FALSE;
        if (Auth::check()){
            if (Auth::user()->role === 2){
                $findLate = DB::select(
                    "SELECT COUNT(*) AS 'count' FROM book_loans
                    WHERE book_loans.id_user = ?
                    AND tanggal_pengembalian IS NULL  
                    AND NOW() >= book_loans.tenggat_pengembalian
                    "
                ,[Auth::user()->id]);               
                if ($findLate[0]->count){
                    $hasLate = TRUE;
                }
            }
        }        
        return view('landing', ['late' => $hasLate]);     
    }

    public function about(){
        // AuthenticatedSessionController::checkEmailVerification();        
        $hasLate = FALSE;
        if (Auth::check()){
            if (Auth::user()->role == 2){
                $findLate = DB::select(
                    "SELECT COUNT(*) AS 'count' FROM book_loans
                    WHERE book_loans.id_user = ?
                    AND tanggal_pengembalian IS NULL  
                    AND NOW() >= book_loans.tenggat_pengembalian
                    "
                ,[Auth::user()->id]);               
                if ($findLate[0]->count){
                    $hasLate = TRUE;
                }
            }
        }           
        return view('panduan',  ['late' => $hasLate]); // TEMP             
    }
    
    public function services(){
        // AuthenticatedSessionController::checkEmailVerification();        
        return view('landing'); // TEMP             
    }    

    public function viewAllStudent(Request $request){

        if ($request->name){
            $students = User::where('role', 2)
                            ->where('name', 'LIKE', '%'.$request->name.'%')
                            ->orderBy('name', 'ASC')
                            ->get();
            return view('students', ['students' => $students]);                            
        }
        $students = User::where('role', 2)->orderBy('name', 'ASC')->get();
        return view('students', ['students' => $students]);
    }

    public function viewStudent($nisn){
        $student = User::where('nisn', $nisn)->get();

        $loans = BookLoan::where('book_loans.id_user', '=', $nisn)
                    ->where('book_loans.tanggal_pengembalian', NULL)
                    ->join('books', 'book_loans.id_buku', '=', 'books.id')
                    ->get();

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
                          AND users.nisn = ?
                        ORDER BY book_loans.tanggal_peminjaman ASC;
                ",[$nisn]);                     


        return view('view-student', ['student'=>$student[0], 'loans' => $loans]);
    }

    public function addStudentView(){
        return view('add-student');
    }

    public function addStudent(Request $request){
        $student = new User;
        $student->nisn = $request->nisn;
        $student->id = "";
        $student->name = $request->name;
        $student->role = 2;
        $student->password = "12345678";
        $student->save();

        return redirect()->back()->with('STUDENT_CREATED', 'Siswa baru berhasil ditambahkan!');
    }
    

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */

     
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function findStudentLS(Request $request){
        $req = $request->query('name');
        $findUser = DB::select('SELECT id, name FROM users WHERE (name LIKE ? OR nisn = ?) AND users.role = 2', ['%'.$req.'%', $req]);
        return $findUser;
    }

    public function testAuth(){
        return view('test-auth-page');
    }

    public function forgetPasswordView(){
        return view('forget-password');
    }

    public function forgetPassword(Request $request){
        
        if ($request->password === $request->confirm_password){
            if (strlen($request->password) < 8){
                return redirect()->back()->with('INVALID_LENGTH', "Password harus lebih panjang atau sama dengan 8 karakter!");
            }
            
            if (Auth::check()){
                $student = User::where('id', Auth::user()->id)->update(
                    ['password' => bcrypt($request->password)]
                );

                return redirect('/')->with('ACTION_SUCCESS', "Pengubahan kata sandi berhasil");

            }

        }

        return redirect()->back()->with("FAIL_CONFIRM", "Password yang dimasukkan tidak sama!");

    }

}
