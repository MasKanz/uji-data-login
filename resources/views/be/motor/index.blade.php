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
                <td><button class="btn"><img src="{{ asset('storage/' . $motor->foto1) }}" alt="Foto Jenis Motor" width="70" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto1 }}"></button></td>
                <td><button class="btn"><img src="{{ asset('storage/' . $motor->foto2) }}" alt="Foto Jenis Motor" width="70" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto2 }}"></button></td>
                <td><button class="btn"><img src="{{ asset('storage/' . $motor->foto3) }}" alt="Foto Jenis Motor" width="70" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto3 }}"></button></td>
                <td>{{ $motor->stok }}</td>
                <td>
                    <div style="width: 100%">
                        <div>
                            <form action="{{ route('motors.detail', $motor->id) }}" method="GET">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Details</button>
                            </form>
                        </div>

                        <div style="display: flex;">

                            <form action="{{ route('motors.edit', $motor->id) }}" method="GET" style="width: 50%; display: inline-flex;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm" style="width: 100%;">Update</button>
                            </form>

                            <form action="{{ route('motors.destroy', $motor->id) }}" method="POST" style="width: 50%; display: inline-flex;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Delete</button>
                            </form>
                        </div>

                    </div>
                </td>
            </tr>

            <div class="modal fade" id="detailsModal{{ $motor->foto1 }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $motor->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $motor->foto1) }}" alt="Foto Jenis Motor" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="detailsModal{{ $motor->foto2 }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $motor->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $motor->foto2) }}" alt="Foto Jenis Motor" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="detailsModal{{ $motor->foto3 }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $motor->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $motor->foto3) }}" alt="Foto Jenis Motor" width="100%">
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
