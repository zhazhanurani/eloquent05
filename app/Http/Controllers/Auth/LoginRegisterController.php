<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;// asuming ur as user
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
        //validate request data
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'

        ]);
        // create a new user
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            //membuat level user
            'level' =>'user',
            'email_verified_at'=>now()

        ]);

        //Login User setalah regristrasi
        $credentials = $request->only('email','password');
        Auth::attempt($credentials);
        // Komentar  Regenerate session: Menandai bahwa sesi akan diperbarui setelah login.
        $request->session()->regenerate();

        //Mail::to($user->email) menentukan alamat email tujuan untuk pengiriman email,
        //Mail::to($user->email)->send(new RegistrationSuccess($user));


        return redirect('/buku')
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

// public function dashboard()
// {
//     if (Auth::check()) {
//         return view('auth.dashboard');
//     }

//     return redirect()->route('login')
//     ->withErrors([
//         'email' => 'Please login to acess the dashboard!',
//     ])->onlyInput('email');
// }

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
