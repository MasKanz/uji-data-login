@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Pembayaran Angsuran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Motor</th>
                <th>Nominal</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angsuran as $item)
            <tr>
                <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>Rp{{ number_format($item->total_bayar,0,',','.') }}</td>
                <td>{{ $item->tgl_bayar }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    @if($item->bukti_bayar)
                        <a href="{{ asset('storage/' . ltrim($item->bukti_bayar, '/')) }}" target="_blank">Lihat Bukti</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
