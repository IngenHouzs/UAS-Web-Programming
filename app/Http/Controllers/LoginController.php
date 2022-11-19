<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{    
    public function showLoginPage(){
        return view('login');
    } 

    public function loginProcess(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        

        $userData = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($userData)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('LOGIN_ERROR', 'Login failed!');
    }
}
