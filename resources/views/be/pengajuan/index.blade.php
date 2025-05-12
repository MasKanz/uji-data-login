@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Pengajuan Kredit</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Motor</th>
                <th>DP</th>
                <th>Tenor</th>
                <th>Bunga</th>
                <th>Asuransi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuanList as $pengajuan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengajuan->tgl_pengajuan_kredit }}</td>
                <td>{{ $pengajuan->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $pengajuan->motor->nama_motor ?? '-' }}</td>
                <td>Rp {{ number_format($pengajuan->dp, 0, ',', '.') }}</td>
                <td>{{ $pengajuan->jenisCicilan->lama_cicilan ?? '-' }} bulan</td>
                <td>{{ isset($pengajuan->jenisCicilan) ? ($pengajuan->jenisCicilan->margin_kredit * 100) . '%' : '-' }}</td>
                <td>{{ $pengajuan->asuransi->nama_asuransi ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $pengajuan->status_pengajuan == 'Menunggu Konfirmasi' ? 'warning' : ($pengajuan->status_pengajuan == 'Diterima' ? 'success' : 'danger') }}">
                        {{ $pengajuan->status_pengajuan }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('pengajuan-kredit.show', $pengajuan->id) }}" class="btn btn-info btn-sm">Detail</a>
                    {{-- Tambahkan tombol proses/approve/tolak sesuai kebutuhan --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
