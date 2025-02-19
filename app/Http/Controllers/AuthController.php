<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller

{

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function index(){
        return view('home');
    }

    // resgistration 
    public function register(Request $request)
    {
        // Debugging request data
        // dd($request->all());
        
        // Or log the request data
        Log::info('Form submitted', $request->all());
        // dd($request->all());

       // Data validation
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


        // Create user
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password),
            
        ]);

        return to_route('login')->with('success', 'Registration successful.');
        
    }

    // login method 
    public function login(Request $request){

        // data validation
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // checking datas
        if (Auth::attempt($credential)){
            return to_route('home')->with('success', 'login sucessfully');
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
