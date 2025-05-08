@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Asuransi</h2>
    <a href="{{ route('asuransi.create') }}" class="btn btn-primary mb-3">Tambah Asuransi</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Nama Asuransi</th>
                <th>Margin (%)</th>
                <th>No Rekening</th>
                <th>Logo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asuransiList as $asuransi)
            <tr>
                <td>{{ $asuransi->nama_perusahaan_asuransi }}</td>
                <td>{{ $asuransi->nama_asuransi }}</td>
                <td>{{ $asuransi->margin_asuransi * 100 }}</td>
                <td>{{ $asuransi->no_rekening }}</td>
                <td>
                    @if($asuransi->url_logo)
                        <img src="{{ asset('storage/'.$asuransi->url_logo) }}" alt="Logo" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('asuransi.edit', $asuransi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('asuransi.destroy', $asuransi->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    </script>
    @endif


    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "@foreach ($errors->all() as $error) {{ $error }} @endforeach",
            confirmButtonText: 'OK'
        });
    </script>
    @endif

@endsection
