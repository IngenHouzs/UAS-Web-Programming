<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
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
        $validate = Validator::make($data, $rules, $messages);
        return $validate;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User();   
        $user->id = "";
        $user->name = $data["name"];
        $user->nisn = $data["nisn"];
        $user->password = $data["password"];
        $user->save();
        return $user;

        
    }
}
