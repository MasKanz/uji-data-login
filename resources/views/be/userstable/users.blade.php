@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('header')
    @include('be.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>User Management</h2>


    <div class="col-md-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary m-2">
            <i data-feather="user-plus"> </i>Add New Users
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>

                <form action="{{ route('users.toggleActive', $user->id) }}" method="POST" style="width: 100%">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm {{ $user->active ? 'btn-danger' : 'btn-success' }}" style="width: 100%;">
                        {{ $user->active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>

                    <div style="width: 100%; display: flex;">

                        <form action="{{ route('users.edit', $user->id) }}" method="GET" style="width: 50%; display: inline-flex;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning btn-sm" style="width: 100%;">Update</button>
                        </form>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="width: 50%; display: inline-flex;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Delete</button>
                        </form>
                    </div>
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
