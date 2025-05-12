@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Kredit</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Pelanggan</th>
                <th>Motor</th>
                <th>Tenor</th>
                <th>Sisa Kredit</th>
                <th>Status Kredit</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kreditList as $kredit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kredit->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>{{ $kredit->pengajuanKredit->jenisCicilan->lama_cicilan ?? '-' }} bulan</td>
                <td>Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $kredit->status_kredit == 'Lunas' ? 'success' : ($kredit->status_kredit == 'Dicicil' ? 'warning' : 'danger') }}">
                        {{ $kredit->status_kredit }}
                    </span>
                </td>
                <td>{{ $kredit->tgl_mulai_kredit }}</td>
                <td>{{ $kredit->tgl_selesai_kredit }}</td>
                <td>
                    <a href="{{ route('kredit.show', $kredit->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
