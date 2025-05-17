@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Metode Bayar</h2>
    <a href="{{ route('metode-bayar.create') }}" class="btn btn-primary mb-3">Tambah Metode Bayar</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Metode</th>
                <th>Tempat Bayar</th>
                <th>No Rekening</th>
                <th>Logo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metodeList as $metode)
            <tr>
                <td>{{ $loop->iteration + ($metodeList->firstItem() - 1) }}</td>
                <td>{{ $metode->metode_pembayaran }}</td>
                <td>{{ $metode->tempat_bayar }}</td>
                <td>{{ $metode->no_rekening }}</td>
                <td>
                    @if($metode->url_logo)
                        <img src="{{ asset('storage/'.$metode->url_logo) }}" alt="Logo" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('metode-bayar.edit', $metode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('metode-bayar.destroy', $metode->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $metodeList->links() }}
</div>
@endsection
