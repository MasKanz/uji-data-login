@extends('be.master')
@section('header')
    @include('be.components.header')
@endsection
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Verifikasi Pembayaran Angsuran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Motor</th>
                <th>Nominal</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angsuranList as $angsuran)
            <tr>
                <td>{{ $angsuran->kredit->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $angsuran->kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>Rp{{ number_format($angsuran->total_bayar,0,',','.') }}</td>
                <td>
                    <a href="{{ asset('storage/'.$angsuran->bukti_bayar) }}" target="_blank">Lihat Bukti</a>
                </td>
                <td>
                    <form action="{{ route('angsuran-verifikasi.terima',$angsuran->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm" onclick="return confirm('Terima pembayaran ini?')">Terima</button>
                    </form>
                    <form action="{{ url('angsuran-verifikasi.tolak',$angsuran->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
