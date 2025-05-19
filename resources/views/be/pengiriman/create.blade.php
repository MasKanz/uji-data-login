@extends('be.master')
@section('header')
    @include('be.components.header')
@endsection
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Form Pengiriman</h2>
    <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_kredit" class="form-label">Pilih Kredit</label>
            <select name="id_kredit" class="form-control" required>
                <option value="">-- Pilih Kredit --</option>
                @foreach($kreditList as $kredit)
                    <option value="{{ $kredit->id }}">
                        {{ $kredit->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }} -
                        {{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="no_invoice" class="form-label">No Invoice</label>
            <input type="text" name="no_invoice" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tgl_kirim" class="form-label">Tanggal Kirim</label>
            <input type="datetime-local" name="tgl_kirim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status_kirim" class="form-label">Status Kirim</label>
            <select name="status_kirim" class="form-control" required>
                <option value="Sedang Dikirim">Sedang Dikirim</option>
                <option value="Tiba Di Tujuan">Tiba Di Tujuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_kurir" class="form-label">Nama Kurir</label>
            <input type="text" name="nama_kurir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telpon_kurir" class="form-label">Telpon Kurir</label>
            <input type="text" name="telpon_kurir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="bukti_foto" class="form-label">Bukti Foto (opsional)</label>
            <input type="file" name="bukti_foto" class="form-control">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Pengiriman</button>
        <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
