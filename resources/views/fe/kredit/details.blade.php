@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Detail Kredit</h2>
    <a href="{{ route('kredit.pelanggan') }}" class="btn btn-secondary mb-3">Kembali</a>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>{{ $kredit->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</strong> - {{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Status Kredit</th><td>{{ $kredit->status_kredit }}</td></tr>
                <tr><th>Keterangan</th><td>{{ $kredit->keterangan_status_kredit }}</td></tr>
                <tr><th>Sisa Kredit</th><td>Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</td></tr>
                <tr><th>Tgl Mulai</th><td>{{ $kredit->tgl_mulai_kredit }}</td></tr>
                <tr><th>Tgl Selesai</th><td>{{ $kredit->tgl_selesai_kredit }}</td></tr>
            </table>
        </div>
    </div>
    <h4>Riwayat Angsuran</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tgl Bayar</th>
                <th>Angsuran Ke</th>
                <th>Total Bayar</th>
                <th>Keterangan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kredit->angsuran as $angsuran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $angsuran->tgl_bayar }}</td>
                <td>{{ $angsuran->angsuran_ke }}</td>
                <td>Rp {{ number_format($angsuran->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $angsuran->keterangan }}</td>
                <td>
                    @if($angsuran->bukti_bayar)
                        <a href="{{ asset('storage/'.$angsuran->bukti_bayar) }}" target="_blank">Lihat Bukti</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
