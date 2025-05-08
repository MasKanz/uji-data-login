@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Tambah Asuransi</h2>
    <form action="{{ route('asuransi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Perusahaan Asuransi</label>
            <input type="text" name="nama_perusahaan_asuransi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Asuransi</label>
            <input type="text" name="nama_asuransi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Margin Asuransi (%)</label>
            <input type="number" step="0.01" name="margin_asuransi" class="form-control" required>
            <small>Contoh: 0.05 untuk 5%</small>
        </div>
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="no_rekening" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Logo (opsional)</label>
            <input type="file" name="url_logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('asuransi') }}" class="btn btn-danger">Kembali</a>
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
