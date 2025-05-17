@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Pelanggan Management</h2>
    <div class="col-md-4">
        <a href="{{ route('pelanggans.create') }}" class="btn btn-primary m-2">
            <i data-feather="user-plus"> </i>Tambahkan Pelanggan
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $pelanggan)
            <tr>
                <td>{{ $loop->iteration + ($pelanggans->firstItem() - 1) }}</td>
                <td>{{ $pelanggan->id }}</td>
                <td>{{ $pelanggan->nama_pelanggan }}</td>
                <td>{{ $pelanggan->email }}</td>
                <td>{{ $pelanggan->no_telp }}</td>

                <td><button class="btn"><img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto Pelanggan" width="70" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $pelanggan->foto }}"></button></td>


                <td>
                    <div>
                        <button type="submit" class="btn btn-success btn-sm" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $pelanggan->id }}">Details</button>
                    </div>

                    <form action="{{ route('pelanggans.toggleAktif', $pelanggan->id) }}" method="POST" style="width: 100%">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $pelanggan->active ? 'btn-danger' : 'btn-success' }}" style="width: 100%;">
                            {{ $pelanggan->active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>

                    <div style="display: flex;">

                        <form action="{{ route('pelanggans.edit', $pelanggan->id) }}" method="GET" style="width: 50%; display: inline-flex;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning btn-sm" style="width: 100%;">Update</button>
                        </form>

                        <form action="{{ route('pelanggans.destroy', $pelanggan->id) }}" method="POST" style="width: 50%; display: inline-flex;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Delete</button>
                        </form>

                    </div>
                </td>
            </tr>

        <!-- Pelanggan's details -->
            <div class="modal modal-xl fade" id="detailsModal{{ $pelanggan->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $pelanggan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel{{ $pelanggan->id }}">Details of {{ $pelanggan->nama_pelanggan }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="display: flex;">
                                <div style="width: 33%;">
                                    <p><strong>ID:</strong> {{ $pelanggan->id }}</p>
                                    <p><strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}</p>
                                    <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
                                    <p><strong>No. Telepon:</strong> {{ $pelanggan->no_telp }}</p>
                                </div>

                                <div style="width: 33%;">
                                    <p><strong>Alamat 1:</strong> {{ $pelanggan->alamat1 }}</p>
                                    <p><strong>Kota 1:</strong> {{ $pelanggan->kota1 }}</p>
                                    <p><strong>Provinsi 1:</strong> {{ $pelanggan->propinsi1 }}</p>
                                    <p><strong>Kode pos 1:</strong> {{ $pelanggan->kodepos1 }}</p>
                                </div>

                                <div style="width: 33%;">
                                    <p><strong>Alamat 2:</strong> {{ $pelanggan->alamat2 }}</p>
                                    <p><strong>Kota 2:</strong> {{ $pelanggan->kota2 }}</p>
                                    <p><strong>Provinsi 2:</strong> {{ $pelanggan->propinsi2 }}</p>
                                    <p><strong>Kode pos 2:</strong> {{ $pelanggan->kodepos2 }}</p>
                                </div>

                                <div style="width: 33%;">
                                    <p><strong>Alamat 3:</strong> {{ $pelanggan->alamat3 }}</p>
                                    <p><strong>Kota 3:</strong> {{ $pelanggan->kota3 }}</p>
                                    <p><strong>Provinsi 3:</strong> {{ $pelanggan->propinsi3 }}</p>
                                    <p><strong>Kode pos 3:</strong> {{ $pelanggan->kodepos3 }}</p>
                                </div>
                            </div>

                            <p><strong>Foto:</strong></p>
                            <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto Pelanggan" width="100">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Pelanggan's Foto -->
            <div class="modal fade" id="detailsModal{{ $pelanggan->foto }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $pelanggan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto Pelanggan" width="100%">
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
    {{ $pelanggans->links() }}
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
