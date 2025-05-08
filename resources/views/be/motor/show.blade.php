@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Motor Details</h2>

    <!-- Motor Details Card -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3><strong>{{ $motor->nama_motor }}</strong></h3>
        </div>
        <div class="card-body">
            <div class="carousel">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $fotos = [];
                            if ($motor->foto1) $fotos[] = $motor->foto1;
                            if ($motor->foto2) $fotos[] = $motor->foto2;
                            if ($motor->foto3) $fotos[] = $motor->foto3;
                        @endphp
                        @foreach($fotos as $i => $foto)
                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100 carousel-img">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

            <div class="row">
                <!-- Motor Information -->
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $motor->id }}</p>
                    <p><strong>Jenis Motor:</strong> {{ $motor->jenisMotor->merk }} - {{ $motor->jenisMotor->jenis }}</p>
                    <p><strong>Harga Jual:</strong> Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                    <p><strong>Deskripsi:</strong> {{ $motor->deskripsi_motor }}</p>
                    <p><strong>Warna:</strong> {{ $motor->warna }}</p>
                    <p><strong>Kapasitas Mesin:</strong> {{ $motor->kapasitas_mesin }}</p>
                    <p><strong>Tahun Produksi:</strong> {{ $motor->tahun_produksi }}</p>
                    <p><strong>Stok:</strong> <span class="badge bg-success">{{ $motor->stok }}</span></p>
                </div>

                <!-- Motor Images -->
                <div class="col-md-6">
                    <h5>Foto Motor</h5>
                    <div class="row">
                        <div class="col-4">
                            <button class="btn"><img src="{{ asset('storage/' . $motor->foto1) }}" alt="Foto 1" class="img-fluid rounded" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto1 }}"></button>
                        </div>
                        <div class="col-4">
                            <button class="btn"><img src="{{ asset('storage/' . $motor->foto2) }}" alt="Foto 2" class="img-fluid rounded" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto2 }}"></button>
                        </div>
                        <div class="col-4">
                            <button class="btn"><img src="{{ asset('storage/' . $motor->foto3) }}" alt="Foto 3" class="img-fluid rounded" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $motor->foto2 }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('motors.edit', $motor->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('motors.destroy', $motor->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
            <a href="{{ route('motors') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>
    </div>
</div>


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
