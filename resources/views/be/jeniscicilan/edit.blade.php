@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Edit Jenis Cicilan</h2>
    <form action="{{ route('jenis-cicilan.update', $jenisCicilan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="lama_cicilan" class="form-label">Lama Cicilan (bulan)</label>
            <input type="number" class="form-control" id="lama_cicilan" name="lama_cicilan" value="{{ $jenisCicilan->lama_cicilan }}" required>
        </div>
        <div class="mb-3">
            <label for="margin_kredit" class="form-label">Margin Kredit (%)</label>
            <input type="number" step="0.01" class="form-control" id="margin_kredit" name="margin_kredit" value="{{ $jenisCicilan->margin_kredit }}" required>
            <small class="text-muted">Contoh: 0.12 untuk 12%</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jenis-cicilan') }}" class="btn btn-danger">Kembali</a>
    </form>
</div>
@endsection
