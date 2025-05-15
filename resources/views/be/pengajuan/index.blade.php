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
                    @if($pengajuan->status_pengajuan == 'Menunggu Konfirmasi')
                        <form action="{{ route('pengajuan-kredit.konfirmasi', $pengajuan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pengajuan ini?')">Konfirmasi</button>
                        </form>
                        <form action="{{ route('pengajuan-kredit.batal', $pengajuan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan pengajuan ini?')">Batalkan</button> -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#batalModal{{ $pengajuan->id }}">
                                Batalkan
                            </button>
                        </form>

                        <div class="modal fade" id="batalModal{{ $pengajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="batalModalLabel{{ $pengajuan->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('pengajuan-kredit.batal', $pengajuan->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="batalModalLabel{{ $pengajuan->id }}">Alasan Pembatalan</h5>
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
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
