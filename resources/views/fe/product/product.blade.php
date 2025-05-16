@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Daftar Motor</h2>
    <form method="GET" action="{{ route('products') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
            <select name="jenis" class="form-control" onchange="this.form.submit()">
                <option value="">-- Semua Jenis --</option>
                @foreach($jenisList as $jenis)
                    <option value="{{ $jenis->jenis }}" {{ request('jenis') == $jenis->jenis ? 'selected' : '' }}>
                        {{ $jenis->jenis }}
                    </option>
                @endforeach
            </select>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($motors as $motor)
        <div class="col-md-4 mb-4" data-aos="fade-up">
            <div class="card h-100">
                @if($motor->foto1)
                    <img src="{{ asset('storage/' . $motor->foto1) }}" class="card-img-top" alt="{{ $motor->nama_motor }}" style="height: 80%; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $motor->nama_motor }}</h5>
                    <p class="card-text">
                        Jenis: {{ $motor->jenisMotor->merk ?? '-' }} - {{ $motor->jenisMotor->jenis ?? '-' }}<br>
                        Harga: Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}<br>
                        Warna: {{ $motor->warna }}<br>
                        Tahun: {{ $motor->tahun_produksi }}
                    </p>
                    @if( $motor->stok > 0 && $motor->stok <= 10)
                        <p><strong>Stok:</strong> <span class="badge bg-warning">{{ $motor->stok }}</span></p>
                    @elseif( $motor->stok > 10)
                        <p><strong>Stok:</strong> <span class="badge bg-success">{{ $motor->stok }}</span></p>
                    @else
                        <p><strong>Stok:</strong> <span class="badge bg-danger">Habis</span></p>
                    @endif
                    <div style="display: inline-flex;">
                        <form action="{{ route('pengajuan') }}" method="GET" style="display: inline-flex; width: 50%">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="id_motor" value="{{ $motor->id }}">
                            <button class="btn btn-primary" type="submit">Ajukan Kredit</button>
                        </form>
                        <form action="{{ route('products.show', $motor->id) }}" method="GET" style="display: inline-flex; width: 50%">
                            <input type="hidden" name="id_motor" value="{{ $motor->id }}">
                            <button class="btn btn-success" type="submit">Lihat Detail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
