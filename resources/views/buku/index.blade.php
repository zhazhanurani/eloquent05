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
                <td>
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
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