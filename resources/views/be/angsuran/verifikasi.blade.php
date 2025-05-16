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
                    <form action="{{ route('angsuran-verifikasi.tolak',$angsuran->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')" data-bs-toggle="modal" data-bs-target="#batalModal{{ $angsuran->id }}">
                            Tolak
                        </button>
                        <!-- <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">Tolak</button> -->
                    </form>

                    <div class="modal fade" id="batalModal{{ $angsuran->id }}" tabindex="-1" role="dialog" aria-labelledby="batalModalLabel{{ $angsuran->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('angsuran-verifikasi.tolak', $angsuran->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="batalModalLabel{{ $angsuran->id }}">Alasan Pembatalan</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                    <label for="alasan_batal">Alasan pembatalan:</label>
                                    <textarea name="alasan_batal" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Kirim</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
