@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Tambah Metode Bayar</h2>
    <form action="{{ route('metode-bayar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Bayar</label>
            <input type="text" name="tempat_bayar" class="form-control" required>
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
        <a href="{{ route('metode-bayar') }}" class="btn btn-danger">Kembali</a>
    </form>
</div>
@endsection
