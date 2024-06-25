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

public function authenticateAdmin(Request $requestAdmin){
    if(Auth::attempt(
        [
            'email' => $requestAdmin->email,
            'password'=>$requestAdmin->password
        ])){
            return redirect('/admin');
        }
        else{
            return redirect()->back()->withErrors(['message'=>'User not found'])->withInput();
        }
    }

    public function registerAdmin(Request $requestAdmin){
        $admin = new \App\Models\Admin;
        $admin->name = $requestAdmin->name;   
        $admin->email = $requestAdmin->email;
        $admin->password = \Hash::make($requestAdmin->password);
        $admin->save();

        return redirect('login')->with('success', 'Registration successful. Please login.');
    }

public function showLoginFormAdmin()
{
    return view('admin.login');
}

public function showRegistrationFormAdmin()
{
    return view('admin.register');
}

}