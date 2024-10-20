@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Buku</h1>
    <form action="{{route('buku.update', $buku->id)}}" method="post">
        @method('post')
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{$buku->judul}}">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" name="penulis" value="{{$buku->penulis}}">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" name="harga" value="{{$buku->harga}}">
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="text" class="form-control" name="tgl_terbit" value="{{$buku->tgl_terbit}}">
        </div>
        <button type="submit" class="btn btn-primary">Update Buku</button>
        <a href="{{'/buku'}}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<div class="footer">
    <p>Halaman Edit</p>
</div>
@endsection



<!-- <div class="container">
    <form action="{{route('buku.update', $buku->id)}}" method="post">
        @method('post')
        @csrf
        <div>Judul <input type="text" name="judul" value="{{$buku->judul}}"></div>
        <div>Penulis <input type="text" name="penulis" value="{{$buku->penulis}}"></div>
        <div>Harga <input type="text" name="harga" value="{{$buku->harga}}"></div>
        <div>Tanggal Terbit <input type="text" name="tgl_terbit" value="{{$buku->tgl_terbit}}"></div>
        <button type="submit" class="btn btn-primary">Update Buku</button>
        <a href="{{'/buku'}}">Kembali</a>
        

    </form>
</div> -->