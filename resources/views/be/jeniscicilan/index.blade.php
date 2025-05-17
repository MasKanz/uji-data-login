@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Jenis Cicilan</h2>
    <a href="{{ route('jenis-cicilan.create') }}" class="btn btn-primary mb-3">Tambah Jenis Cicilan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Lama Cicilan (bulan)</th>
                <th>Margin Kredit (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisCicilan as $cicilan)
            <tr>
                <td>{{ $loop->iteration + ($jenisCicilan->firstItem() - 1) }}</td>
                <td>{{ $cicilan->id }}</td>
                <td>{{ $cicilan->lama_cicilan }}</td>
                <td>{{ $cicilan->margin_kredit * 100 }}</td>
                <td>
                    <a href="{{ route('jenis-cicilan.edit', $cicilan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jenis-cicilan.destroy', $cicilan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $jenisCicilan->links() }}
</div>
@endsection
