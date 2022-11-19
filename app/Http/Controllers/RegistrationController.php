<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    
    public function showSignUpPage(){
        return view('signup');
    }

    public function createUserProcess(Request $request){

        $rules = [
            'name' => 'required|unique:users,name', 
            'email' => 'required|unique:users,email', 
            'password' => 'min:8'            
        ];

        $messages = [
            'name.required' => 'Kolom nama tidak boleh kosong.',
            'email.required' => 'Kolom email tidak boleh kosong.',
            'password.min' => 'Password harus lebih panjang dari 8 karakter.'
        ];
    


        $validate = Validator::make($request->all(), $rules, $messages);

        if ($validate->fails()){
            return redirect('/registration')
                ->withErrors($validate);
        }



        $user = new User();   
        $user->id = "";
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
   
        // Auto login after registration (kalo misal mau loginnya manual aja, ini dua line dibawah di apus / comment aja)
        Auth::login($user);
        $request->session()->regenerate();        

        return redirect('/')->withSuccess("Pembuatan akun berhasil!");    
    }

}
