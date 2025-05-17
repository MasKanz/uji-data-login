@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
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
                <th>#</th>
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
                <td>{{ $loop->iteration + ($jenisList->firstItem() - 1) }}</td>
                <td>{{ $jenis_motor->id }}</td>
                <td>{{ $jenis_motor->merk }}</td>
                <td>{{ $jenis_motor->jenis }}</td>
                <td>{{ $jenis_motor->deskripsi_jenis }}</td>
                <td><button class="btn"><img src="{{ asset('storage/' . $jenis_motor->image_url) }}" alt="Foto Jenis Motor" width="70" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $jenis_motor->image_url }}"></button></td>

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

            <div class="modal fade" id="detailsModal{{ $jenis_motor->image_url }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $jenis_motor->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $jenis_motor->image_url) }}" alt="Foto Jenis Motor" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </tbody>
    </table>
    {{ $jenisList->links() }}
</div>


<!-- Jenis Motor Foto -->



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
