<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller

{
    public function adminDashboard(){
        return view('admin.dashboard');

    }
    public function userDashboard(){
        return view('user.dashboard');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm(){
        if (Auth::user()){
            return view('user.dashbord');
        }
        return view('auth.login');
    }

    public function index(){
        if (Auth::user()->role === 'admin'){
            return to_route('admin');
        }

        return to_route('user');
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
    public function login(Request $request)
{
    $credential = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credential)) {
        $request->session()->regenerate();
        
        // Redirection based on the role 
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin');
        }
        return redirect()->route('user');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect'
    ]);
}
    // logout method 
    public function logout(Request $request){
        auth()->logout();

        // $request = session->invalidate();
        // $request = session->regenerateToken();

        return to_route('login');
    }
}
