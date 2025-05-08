@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('header')
    @include('be.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Edit Asuransi</h2>
    <form action="{{ route('asuransi.update', $asuransi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Perusahaan Asuransi</label>
            <input type="text" name="nama_perusahaan_asuransi" class="form-control" value="{{ $asuransi->nama_perusahaan_asuransi }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Asuransi</label>
            <input type="text" name="nama_asuransi" class="form-control" value="{{ $asuransi->nama_asuransi }}" required>
        </div>
        <div class="mb-3">
            <label>Margin Asuransi (%)</label>
            <input type="number" step="0.01" name="margin_asuransi" class="form-control" value="{{ $asuransi->margin_asuransi }}" required>
            <small>Contoh: 0.05 untuk 5%</small>
        </div>
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="no_rekening" class="form-control" value="{{ $asuransi->no_rekening }}" required>
        </div>
        <div class="mb-3">
            <label>Logo (opsional)</label>
            <input type="file" name="url_logo" class="form-control">
            @if($asuransi->url_logo)
                <img src="{{ asset('storage/'.$asuransi->url_logo) }}" alt="Logo" width="50">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('asuransi') }}" class="btn btn-danger">Kembali</a>
    </form>
</div>
@endsection
