@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')

@foreach($pengajuans as $pengajuan)
    @if($pengajuan->status_pengajuan == 'Dibatalkan Penjual' && $pengajuan->keterangan_status_pengajuan && !$pengajuan->notif_ditolak_dibaca)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Pengajuan Kredit Dibatalkan',
                    html: `<b>Alasan:</b> {{ $pengajuan->keterangan_status_pengajuan }}`,
                    confirmButtonText: 'OK'
                }).then(function() {
                    document.getElementById('notif-baca-{{ $pengajuan->id }}').submit();
                });
            });
        </script>
        <form id="notif-baca-{{ $pengajuan->id }}" action="{{ route('pengajuan.notifdibaca', $pengajuan->id) }}" method="POST" style="display:none;">
            @csrf
        </form>
        @break
    @endif
@endforeach

<div class="container mt-5">
    <h2>Pengajuan Kredit Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Motor</th>
                <th>Tenor</th>
                <th>DP</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $pengajuan)
            <tr>
                <td>{{ $loop->iteration + ($pengajuans->firstItem() - 1) }}</td>
                <td>{{ $pengajuan->tgl_pengajuan_kredit }}</td>
                <td>{{ $pengajuan->motor->nama_motor ?? '-' }}</td>
                <td>{{ $pengajuan->jenisCicilan->lama_cicilan ?? '-' }} bulan</td>
                <td>Rp {{ number_format($pengajuan->dp,0,',','.') }}</td>
                <td>
                    <span class="badge bg-{{ $pengajuan->status_pengajuan == 'Menunggu Konfirmasi' ? 'warning' : ($pengajuan->status_pengajuan == 'Diterima' ? 'success' : 'danger') }}">
                        {{ $pengajuan->status_pengajuan }}
                    </span>
                </td>
                <td>{{ $pengajuan->keterangan_status_pengajuan }}</td>
                <td>
                    <a href="{{ route('pengajuan.pelanggan-details', $pengajuan->id) }}" class="btn btn-info btn-sm">Detail</a>
                    @if($pengajuan->status_pengajuan == 'Menunggu Konfirmasi')
                    <form action="{{ route('pengajuan.pelanggan.batal', $pengajuan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan pengajuan ini?')">Batalkan</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pengajuans->links() }}
</div>
@endsection
