@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Tambah Jenis Cicilan</h2>
    <form action="{{ route('jenis-cicilan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="lama_cicilan" class="form-label">Lama Cicilan (bulan)</label>
            <input type="number" class="form-control" id="lama_cicilan" name="lama_cicilan" required>
        </div>
        <div class="mb-3">
            <label for="margin_kredit" class="form-label">Margin Kredit (%)</label>
            <input type="number" step="0.01" class="form-control" id="margin_kredit" name="margin_kredit" required>
            <small class="text-muted">Contoh: 0.12 untuk 12%</small>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenis-cicilan') }}" class="btn btn-danger">Kembali</a>
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
