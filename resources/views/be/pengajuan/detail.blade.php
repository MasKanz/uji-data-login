@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Detail Pengajuan Kredit</h2>
    <a href="{{ route('pengajuan-kredit') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pengajuan</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>{{ $pengajuan->pelanggan->nama_pelanggan ?? '-' }}</strong> - {{ $pengajuan->motor->nama_motor ?? '-' }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $pengajuan->tgl_pengajuan_kredit }}</td>
                </tr>
                <tr>
                    <th>Motor</th>
                    <td>{{ $pengajuan->motor->nama_motor ?? '-' }}</td>
                </tr>
                <tr>
                    <th>DP</th>
                    <td>Rp {{ number_format($pengajuan->dp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tenor</th>
                    <td>{{ $pengajuan->jenisCicilan->lama_cicilan ?? '-' }} bulan</td>
                </tr>
                <tr>
                    <th>Bunga</th>
                    <td>{{ isset($pengajuan->jenisCicilan) ? ($pengajuan->jenisCicilan->margin_kredit * 100) . '%' : '-' }}</td>
                </tr>
                <tr>
                    <th>Asuransi</th>
                    <td>{{ $pengajuan->asuransi->nama_asuransi ?? '-' }} ({{ $pengajuan->asuransi->nama_perusahaan_asuransi ?? '-' }})</td>
                </tr>
                <tr>
                    <th>Biaya Asuransi / Bulan</th>
                    <td>Rp {{ number_format($pengajuan->biaya_asuransi_perbulan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Cicilan / Bulan</th>
                    <td>Rp {{ number_format($pengajuan->cicilan_perbulan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $pengajuan->status_pengajuan == 'Menunggu Konfirmasi' ? 'warning' : ($pengajuan->status_pengajuan == 'Diterima' ? 'success' : 'danger') }}">
                            {{ $pengajuan->status_pengajuan }}
                        </span>
                        <br>
                        <small>{{ $pengajuan->keterangan_status_pengajuan }}</small>
                    </td>
                </tr>
                <tr>
                    <th>Dokumen KK</th>
                    <td>
                        @if($pengajuan->url_kk)
                            <a href="{{ asset('storage/'.$pengajuan->url_kk) }}" target="_blank">Lihat KK</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dokumen KTP</th>
                    <td>
                        @if($pengajuan->url_ktp)
                            <a href="{{ asset('storage/'.$pengajuan->url_ktp) }}" target="_blank">Lihat KTP</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dokumen NPWP</th>
                    <td>
                        @if($pengajuan->url_npwp)
                            <a href="{{ asset('storage/'.$pengajuan->url_npwp) }}" target="_blank">Lihat NPWP</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Slip Gaji</th>
                    <td>
                        @if($pengajuan->url_slip_gaji)
                            <a href="{{ asset('storage/'.$pengajuan->url_slip_gaji) }}" target="_blank">Lihat Slip Gaji</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Foto Diri</th>
                    <td>
                        @if($pengajuan->url_foto)
                            <a href="{{ asset('storage/'.$pengajuan->url_foto) }}" target="_blank">Lihat Foto</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
