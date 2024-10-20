<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="mt-5">
    <h2 class="text-center mb-4">Daftar Buku</h2>
    <a href="{{route('buku.create')}}" class = "btn btn-primary float-end">Tambah Buku</a>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $index => $buku)
            <tr>
                <td>{{ $index+1}}</td>
                <td>{{ $buku->judul}}</td>
                <td>{{ $buku->penulis}}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 2, ',', ',')}}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td class="d-flex justify-content-start">
                     <!-- mengatur agar edit dan delete sejajar -->
                    
                    <form action="{{route('buku.destroy', $buku->id ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin nih mau di hapus? ;D')" type="submit"
                        class="btn btn-danger">
                            Hapus</button>

                    </form>

                    
                    <a href="{{route('buku.edit', $buku->id)}}" class="btn btn-success ms-2">Edit</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan jumlah data buku-->
     <p>Jumlah buku: {{ $jumlah_buku }} </p>

    <!-- Menampilkan total harga semua buku -->
     <p>Total harga semua buku: Rp {{number_format($total_harga,0,',','.')}}</p>
    
</body>
</html>