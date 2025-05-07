@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Ajukan Kredit Motor</h2>
    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="motor">Pilih Motor</label>
            <select name="id_motor" class="form-control" required>
                @foreach($motors as $motor)
                    <option value="{{ $motor->id }}">{{ $motor->nama_motor }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dp">DP (Down Payment)</label>
            <input type="number" name="dp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tenor">Tenor (bulan)</label>
            <select name="id_jenis_cicilan" class="form-control" required>
                @foreach($jenisCicilan as $cicilan)
                    <option value="{{ $cicilan->id }}">{{ $cicilan->tenor }} bulan</option>
                @endforeach
            </select>
        </div>
        <!-- Upload dokumen -->
        <div class="mb-3">
            <label for="url_ktp">Upload KTP</label>
            <input type="file" name="url_ktp" class="form-control" required>
        </div>
        <!-- Tambahkan upload KK, NPWP, Slip Gaji, Foto Diri sesuai kebutuhan -->
        <button type="submit" class="btn btn-primary">Ajukan Kredit</button>
    </form>
</div>
@endsection
