@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Pengiriman Motor Saya</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>No Invoice</th>
                <th>Motor</th>
                <th>Tanggal Kirim</th>
                <th>Tanggal Tiba</th>
                <th>Status</th>
                <th>Kurir</th>
                <th>Telpon Kurir</th>
                <th>Bukti Foto</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengirimanList as $pengiriman)
            <tr>
                <td>{{ $loop->iteration + ($pengirimanList->firstItem() - 1) }}</td>
                <td>{{ $pengiriman->no_invoice }}</td>
                <td>{{ $pengiriman->kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>{{ $pengiriman->tgl_kirim }}</td>
                <td>{{ $pengiriman->tgl_tiba ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'warning' : 'success' }}">
                        {{ $pengiriman->status_kirim }}
                    </span>
                </td>
                <td>{{ $pengiriman->nama_kurir }}</td>
                <td>{{ $pengiriman->telpon_kurir }}</td>
                <td>
                    @if($pengiriman->bukti_foto)
                        <a href="{{ asset('storage/' . $pengiriman->bukti_foto) }}" target="_blank">Lihat Foto</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $pengiriman->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">Belum ada data pengiriman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $pengirimanList->links() }}
</div>
@endsection
