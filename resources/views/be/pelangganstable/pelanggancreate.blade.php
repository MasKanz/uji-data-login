@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Tambahkan Pelanggan Baru</h2>
    <form action="{{ route('pelanggans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="katakunci" name="katakunci" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="katakunci_confirmation" name="katakunci_confirmation" required>
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan Pelanggan</button>
        <a href="/pelanggans" class="btn btn-danger">Kembali</a>

    </form>
</div>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    </script>
    @endif


    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "@foreach ($errors->all() as $error) {{ $error }} @endforeach",
            confirmButtonText: 'OK'
        });
    </script>
    @endif
@endsection
