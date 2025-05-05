@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Update Motor : {{ $motor->nama_motor }} </h2>
    <form action="{{ route('motors.update', $motor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_motor" class="form-label">Nama Motor</label>
            <input type="text" class="form-control" id="nama_motor" name="nama_motor" value="{{ $motor->nama_motor }}" required>
        </div>
        <div class="mb-3">
            <label for="idjenis" class="form-label">Jenis</label>
            <select class="form-control" id="idjenis" name="idjenis" required>
                <option value="" disabled selected>Pilih Jenis Motor</option>
                @foreach ($jenisList as $jenis_motor)
                    <option value="{{ $jenis_motor->id }}" {{ $motor->idjenis === $jenis_motor->id ? 'selected' : '' }}>{{ $jenis_motor->merk }} - {{ $jenis_motor->jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $motor->harga_jual }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_motor" class="form-label">Deskripsi Motor</label>
            <input type="text" class="form-control" id="deskripsi_motor" name="deskripsi_motor" value="{{ $motor->deskripsi_motor }}" required>
        </div>
        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" class="form-control" id="warna" name="warna" value="{{ $motor->warna }}" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas_mesin" class="form-label">Kapasitas Mesin</label>
            <input type="text" class="form-control" id="kapasitas_mesin" name="kapasitas_mesin" value="{{ $motor->kapasitas_mesin }}" required>
        </div>
        <div class="mb-3">
            <label for="tahun_produksi" class="form-label">Tahun Produksi</label>
            <input type="text" class="form-control" id="tahun_produksi" name="tahun_produksi" value="{{ $motor->tahun_produksi }}" required>
        </div>
        <div class="mb-3">
            <label for="foto1" class="form-label">Foto 1</label>
            <input type="file" class="form-control" id="foto1" name="foto1" accept="image/*" value="{{ $motor->foto1 }}">
        </div>
        <div class="mb-3">
            <label for="foto2" class="form-label">Foto 2</label>
            <input type="file" class="form-control" id="foto2" name="foto2" value="{{ $motor->foto2 }}" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="foto3" class="form-label">Foto 3</label>
            <input type="file" class="form-control" id="foto3" name="foto3" value="{{ $motor->foto3 }}" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control" id="stok" name="stok" value="{{ $motor->stok }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Jenis Motor</button>
        <a href="{{ route('motors') }}" class="btn btn-danger">Back</a>
    </form>
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
