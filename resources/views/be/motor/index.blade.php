@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Motor Management</h2>


    <div class="col-md-4">
        <a href="{{ route('motors.create') }}" class="btn btn-primary m-2">
            <i data-feather="shopping-cart"> </i>Add New Motorbikes
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Motor</th>
                <th>Id Jenis</th>
                <th>Harga Jual</th>
                <th>Deskripsi Motor</th>
                <th>Warna</th>
                <th>Kapasitas Mesin</th>
                <th>Tahun Produksi</th>
                <th>Foto 1</th>
                <th>Foto 2</th>
                <th>Foto 3</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($motors as $motor)
            <tr>
                <td>{{ $motor->id }}</td>
                <td>{{ $motor->nama_motor }}</td>
                <td>{{ $motor->idjenis }}</td>
                <td>{{ $motor->harga_jual }}</td>
                <td>{{ $motor->deskripsi_motor }}</td>
                <td>{{ $motor->warna }}</td>
                <td>{{ $motor->kapasitas_mesin }}</td>
                <td>{{ $motor->tahun_produksi }}</td>
                <td>{{ $motor->foto1 }}</td>
                <td>{{ $motor->foto2 }}</td>
                <td>{{ $motor->foto3 }}</td>
                <td>{{ $motor->stok }}</td>
                <td>
                    <form action="{{ route('motors.edit', $motor->id) }}" method="GET">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                    </form>

                    <form action="{{ route('motors.destroy', $motor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
