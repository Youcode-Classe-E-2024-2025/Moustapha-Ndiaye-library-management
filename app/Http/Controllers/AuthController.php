<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller

{

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    // resgistration 
    public function register(Request $request){
        // data validation
        $request = validate([
            'fullname' => 'require',
            'email' => 'required | email | unique:users',
            'password' => 'required | min : 6 | confirmed',
        ]);

        // create user
        User::create([
            'fullname' => $request -> fullname,
            'email' => $request -> email,
            'password' => hash::make($request->password)
        ]);

        return redirect() -> route('login') -> with('sucess', 'registration sucessfuly');
    }

    // login method 
    public function login(Request $request){

        // data validation
        $request = validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        // checking datas
        if (Auth::attempt($request('email', 'password'))){
            return redirect()->route('home')->with('success', 'login sucessfully');
        }

        // error message
        return back()->withErrors([
            'email' => 'Email or password incorrect'
        ]);
    }

    // logout method 
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login');
    }
}
