<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

class UserController extends Controller
{
    public function index(){
        // AuthenticatedSessionController::checkEmailVerification();
        return view('landing');
    }

    public function home(){
        // AuthenticatedSessionController::checkEmailVerification();        
        return view('landing'); // TEMP        
    }

    public function about(){
        // AuthenticatedSessionController::checkEmailVerification();        
        return view('landing'); // TEMP             
    }
    
    public function services(){
        // AuthenticatedSessionController::checkEmailVerification();        
        return view('landing'); // TEMP             
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
    
        header('Content-Type: application/json');        
        $req = $request->all();
        return json_encode($req);

    }

    public function testAuth(){
        return view('test-auth-page');
    }
    
}
