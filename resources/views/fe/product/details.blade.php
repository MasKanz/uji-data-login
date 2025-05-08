@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
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
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $motor->foto1) }}" class="d-block w-100 carousel-img" alt="Foto 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $motor->foto2) }}" class="d-block w-100 carousel-img" alt="Foto 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $motor->foto3) }}" class="d-block w-100 carousel-img" alt="Foto 3">
                        </div>
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
            <form action="{{ route('pengajuan', $motor->id) }}" method="GET" class="d-inline">
                @csrf
                @method('GET')
                <input type="hidden" name="id_motor" value="{{ $motor->id }}">
                <button class="btn btn-primary" type="submit">Ajukan Kredit</button>
            </form>
            <a href="{{ route('products') }}" class="btn btn-secondary">Back</a>
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

@endsection
