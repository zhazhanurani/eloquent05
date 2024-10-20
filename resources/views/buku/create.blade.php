@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Buku</h1>
    <form action="{{route('buku.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" placeholder="Masukkan judul buku">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" name="penulis" placeholder="Masukkan penulis buku">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" name="harga" placeholder="Masukkan harga buku">
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="date" class="form-control" name="tgl_terbit">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{'/buku'}}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<div class="footer">
    <p>Halaman Create Buku</p>
</div>
@endsection


<!-- <div class="container">
    <h4>Tambah Buku</h4>
    <form action="{{route('buku.store')}}" method="post">
        @method('POST')
        @csrf
        <div>Judul <input type="text" name="judul"></div>
        <div>Penulis <input type="text" name="penulis"></div>
        <div>Harga <input type="text" name="harga"></div>
        <div>Tanggal Terbit <input type="date" name="tgl_terbit"></div>
        <button type="submit"> Simpan </button>
        <a href="{{'/buku'}}">Kembali</a>
    </form>
</div> -->