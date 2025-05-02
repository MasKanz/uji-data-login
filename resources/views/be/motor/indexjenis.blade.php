@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Jenis Motor Management</h2>


    <div class="col-md-4">
        <a href="{{ route('jenis-motors.create') }}" class="btn btn-primary m-2">
            <i data-feather="shopping-cart"> </i>Add New Variant
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Merk</th>
                <th>Jenis</th>
                <th>Deskripsi Jenis</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisList as $jenis_motor)
            <tr>
                <td>{{ $jenis_motor->id }}</td>
                <td>{{ $jenis_motor->merk }}</td>
                <td>{{ $jenis_motor->jenis }}</td>
                <td>{{ $jenis_motor->deskripsi_jenis }}</td>
                <td>{{ $jenis_motor->image_url }}</td>

                <td>
                    <form action="{{ route('jenis-motors.edit', $jenis_motor->id) }}" method="GET">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                    </form>

                    <form action="{{ route('jenis-motors.destroy', $jenis_motor->id) }}" method="POST">
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
