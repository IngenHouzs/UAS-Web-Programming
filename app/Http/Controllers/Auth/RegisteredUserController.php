<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => ['required','unique:users,name'], 
            'nisn' => ['required','unique:users,nisn'], 
            'password' => ['required','min:8', 'confirmed', Rules\Password::defaults()]
        ];
        $messages = [
            'name.required' => 'Kolom nama tidak boleh kosong.',
            'nisn.required' => 'Kolom NISN tidak boleh kosong.',
            'password.min' => 'Password harus lebih panjang dari 8 karakter.'
        ];
    


        $validate = Validator::make($request->all(), $rules, $messages);

        if ($validate->fails()){
            return redirect('/register')
                ->withErrors($validate);
        }

        $user = new User();   
        $user->id = "";
        $user->name = $request->name;
        $user->nisn = $request->nisn;
        $user->password = $request->password;
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        
        // if (Auth::check()){
        //     return redirect('/email/verify');
        // }
        return redirect(RouteServiceProvider::HOME);
    }
}
