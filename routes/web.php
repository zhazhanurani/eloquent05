<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/buku', [BooksController::class,'index'])->name('buku.index');
Route::get('/buku/create', [BooksController::class,'create'])->name('buku.create');
Route::post('/buku', [BooksController::class,'store'])->name('buku.store');
Route::delete('/buku/{id}', [BooksController::class,'destroy'])->name('buku.destroy');
Route::get('/buku/{id}/edit', [BooksController::class,'edit'])->name('buku.edit');
Route::post('/buku/{id}/update', [BooksController::class,'update'])->name('buku.update');

Route::get('buku/search', [BooksController::class, 'search'])->name('buku.search');


/*Custom Registration login dan routes*/


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });
