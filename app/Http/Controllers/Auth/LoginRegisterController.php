<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /*INSTANTIATE new LoginRegisterController */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    // Display registration form
    // @return \Illuminate\Http\Response
    public function register() {
        return view('auth.register');        
    }

    // Store a new user
    // @param \Illuminate\Http\Request $request
    // @return \Illuminate\Http\Response
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'

        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $credentials = $request->only('email','password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered and logged in!');

    }


    // Display a login form
    // @return \Illuminate\Http\Response
    public function login(){
        return view('auth.login');
    }

    // Authenticate the user
    // @param \Illuminate\Http\Request $request
    // @return \Illuminate\Http\Response
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'        
    ]);
    if (Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have sucessfully logged in!');
    }
    return back()->withErrors([
        'email'=> 'Your provided credentials do not match in our records.',
        ])
        ->onlyInput('email'); 
    }

    
    // Display a dashboard to authenticated users
    // @return \Illuminate\Http\Response

public function dashboard()
{
    if (Auth::check()) {
        return view('auth.dashboard');
    }

    return redirect()->route('login')
    ->withErrors([
        'email' => 'Please login to acess the dashboard!',
    ])->onlyInput('email');
}

    // Logout the user from application
    // @param \Illuminate\Http\Request $request
    // @return \Illuminate\Http\Response

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerate();
    return redirect()->route('login')
    ->withSuccess('You have logged out successfully');
}
    

}
