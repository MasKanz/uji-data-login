@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Ajukan Kredit Motor</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_motor">Pilih Motor</label>
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
            <label for="id_jenis_cicilan">Tenor (bulan)</label>
            <select name="id_jenis_cicilan" class="form-control" required>
                @foreach($jenisCicilan as $cicilan)
                    <option value="{{ $cicilan->id }}">{{ $cicilan->lama_cicilan }} bulan (Bunga: {{ $cicilan->margin_kredit * 100 }}%)</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_asuransi">Pilih Asuransi</label>
            <select name="id_asuransi" class="form-control" required>
                @foreach($asuransiList as $asuransi)
                    <option value="{{ $asuransi->id }}">{{ $asuransi->nama_asuransi }} ({{ $asuransi->nama_perusahaan_asuransi }}, {{ $asuransi->margin_asuransi }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="url_kk">Upload KK</label>
            <input type="file" name="url_kk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="url_ktp">Upload KTP</label>
            <input type="file" name="url_ktp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="url_npwp">Upload NPWP</label>
            <input type="file" name="url_npwp" class="form-control">
        </div>
        <div class="mb-3">
            <label for="url_slip_gaji">Upload Slip Gaji</label>
            <input type="file" name="url_slip_gaji" class="form-control">
        </div>
        <div class="mb-3">
            <label for="url_foto">Upload Foto Diri</label>
            <input type="file" name="url_foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Kredit</button>
    </form>
</div>
@endsection
