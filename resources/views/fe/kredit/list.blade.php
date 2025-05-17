@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Kredit Berjalan Saya</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Motor</th>
                <th>Tenor</th>
                <th>Sisa Kredit</th>
                <th>Status</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kredits as $kredit)
            <tr>
                <td>{{ $loop->iteration + ($kredits->firstItem() - 1) }}</td>
                <td>{{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>{{ $kredit->pengajuanKredit->jenisCicilan->lama_cicilan ?? '-' }} bulan</td>
                <td>Rp {{ number_format($kredit->sisa_kredit,0,',','.') }}</td>
                <td>
                    <span class="badge bg-{{ $kredit->status_kredit == 'Dicicil' ? 'warning' : ($kredit->status_kredit == 'Lunas' ? 'success' : 'danger') }}">
                        {{ $kredit->status_kredit }}
                    </span>
                </td>
                <td>{{ $kredit->tgl_mulai_kredit }}</td>
                <td>{{ $kredit->tgl_selesai_kredit }}</td>
                <td>
                    <a href="{{ route('kredit.pelanggan-details', $kredit->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kredits->links() }}
</div>
@endsection
