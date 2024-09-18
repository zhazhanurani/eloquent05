<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        //mengambil semua data buku dan mengurutkannya berdasarkan id secara  descending
        $data_buku = Buku::all()->sortByDesc('id');
        
        //menghitung data jumlah buku
        $jumlah_buku = $data_buku->count();
        
        // menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        //var_dump($data_buku);exit;
        return view('buku.index', compact('data_buku', 'jumlah_buku','total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
