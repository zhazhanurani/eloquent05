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
         //peginate  di controller
        $batas = 5;
        //mengambil semua data buku dan mengurutkannya berdasarkan id secara  descending
        $data_buku = Buku::orderByDesc('id')->paginate($batas);

        $no = $batas * ($data_buku->currentPage() - 1);
        
        //menghitung data jumlah buku
        $jumlah_buku = $data_buku->count();
        
        // menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        //var_dump($data_buku);exit;
        return view('buku.index', compact('data_buku', 'jumlah_buku','total_harga'));

       
    }

    public function search(Request $request){
        //peginate  di controller
       $batas = 5;
       //data buku
       $cari = $request->kata;
       $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")
       ->paginate($batas);

       $no = $batas * ($data_buku->currentPage() - 1);
       
       //menghitung data jumlah buku
       $jumlah_buku = $data_buku->count();

        // menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

       //var_dump($data_buku);exit;
       return view('buku.search', compact('data_buku', 'jumlah_buku','total_harga', 'no', 'cari'));

      
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul'     => 'required|string',
            'penulis'   => 'required|string|max:30',
            'harga'     => 'required|numeric',
            'tgl_terbit'=> 'required|date',
        ]);
        return view('store', ['data' => '$request']);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');
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
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->only(['judul','penulis','harga','tgl_terbit']));

        return redirect()->route('buku.index')->with('pesanUpdate', 'Data Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Delete');
    }

    public function __construct(){
        $this->middleware('auth');        
    }
}
