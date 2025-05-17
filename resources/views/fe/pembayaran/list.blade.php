@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')

@foreach($angsuran as $item)
    @if($item->keterangan == 'Ditolak' && !$item->notif_ditolak_dibaca)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Angsuran Ditolak',
                    html: `<b>Alasan:</b> {{ $item->keterangan_keterangan ?? '-' }}`,
                    confirmButtonText: 'OK'
                }).then(function() {
                    document.getElementById('notif-baca-{{ $item->id }}').submit();
                });
            });
        </script>
        <form id="notif-baca-{{ $item->id }}" action="{{ route('pembayaran.notifdibaca', $item->id) }}" method="POST" style="display:none;">
            @csrf
        </form>
        @break
    @endif
@endforeach

<div class="container mt-5">
    <h2>Daftar Pembayaran Angsuran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
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
                <td>{{ $loop->iteration + ($angsuran->firstItem() - 1) }}</td>
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
    {{ $angsuran->links() }}
</div>
@endsection
