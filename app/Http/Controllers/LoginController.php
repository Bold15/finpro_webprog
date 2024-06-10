<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use DB;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        if(Auth::attempt(
            [
                'email' => $request->email,
                'password'=>$request->password
            ])){
                return redirect('home');
            }
            else{
                return redirect()->back()->withErrors(['message'=>'User not found'])->withInput();
            }
        }
    public function register(Request $request){
        $user = new \App\Models\User;
        $user->name = $request->name;   
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();

        return redirect('login')->with('success', 'Registration successful. Please login.');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('home');
    }

    public function showLoginForm()
{
    return view('login');
}

public function showRegistrationForm()
{
    return view('register');
}

}