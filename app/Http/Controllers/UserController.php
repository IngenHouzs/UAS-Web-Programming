<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class UserController extends Controller
{
    public function index(){
        return view("landing");
    }

    public function logOut(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();        
        $request->session()->flush();              
        return Redirect::route('index');
    }

    // CUMA FUNGSI PROTOTIPE BUAT COBA AUTH
    public function testAuth(){
        return view('testfeature');
    }
}
