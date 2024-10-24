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

@if(count($data_buku))
    <div class="alret-success"> Ditemukan <strong>{{count($data_buku)}}</strong>
        data dengan kata: <strong>{{ $cari }}</strong></div>
            <!-- Tombol kembali -->
    <a href="/buku" class="btn btn-success">Kembali</a>

@else
    <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan </h4>
    <a href="/buku" class="btn btn-warning">Kembali</a></div>
@endif

<div class="mt-5">
    
    @if(Session::has('pesan'))
    <!-- <div class="alret alret-success">{{Session::get('pesan')}}</div> -->
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 1.5rem; text-align: center;">
        {{ session('pesan') }}
    </div>
    @endif
    @if(Session::has('pesanUpdate'))
    <!-- <div class="alret alret-success">{{Session::get('pesanUpdate')}}</div> -->
    <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 1.5rem; text-align: center;">
        {{ session('pesanUpdate') }}
    </div>
    @endif 

    <script>
    // Menghilangkan alert setelah 5 detik
    setTimeout(function() {
        let alertElement = document.querySelector('.alert');
        if (alertElement) {
            alertElement.classList.remove('show');
            alertElement.classList.add('hide');
            setTimeout(() => alertElement.remove(), 1000); // Hapus dari DOM setelah animasi selesai
        }
    }, 5000); // Waktu dalam milidetik (5000 ms = 5 detik)
    </script>





    <h2 class="text-center mb-4">Daftar Buku</h2>
    
    <form action="{{route('buku.search')}}" method="get">
        @csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari..." 
        style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">

    </form>
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
                <td>{{ "Rp. ".number_format($buku->harga, 0, ',', ',')}}</td>
                <td>{{ $buku->tgl_terbit }}</td>
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


    <!-- menambahkan pagination-->
    <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
    <!-- Menampilkan jumlah data buku-->
    <div><strong>Jumlah Buku: {{ $jumlah_buku }} </strong></div>

    <!-- Menampilkan total harga semua buku -->
     <div><strong>Total harga semua buku: Rp {{number_format($total_harga,0,',','.')}}</strong></div>



@endsection
    
</body>
</html>