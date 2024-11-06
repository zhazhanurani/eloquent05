<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sedang login dan memiliki level admin
       // Auth::user(): Mengambil data pengguna yang sedang login.
        if(!Auth::user()->level == 'admin'){
            return redirect()->back();
        }
        return $next($request);
    }
}
