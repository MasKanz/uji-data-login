@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Tambahkan Motor Baru</h2>
    <form action="{{ route('motors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Motor</label>
            <input type="text" class="form-control" id="nama_motor" name="nama_motor" required>
        </div>
        <div class="mb-3">
            <label for="idjenis" class="form-label">Id Jenis</label>
            <input type="number" class="form-control" id="idjenis" name="idjenis" required>
        </div>
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_motor" class="form-label">Deskripsi Motor</label>
            <input type="text" class="form-control" id="deskripsi_motor" name="deskripsi_motor" required>
        </div>
        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" class="form-control" id="warna" name="warna" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas_mesin" class="form-label">Kapasitas Mesin</label>
            <input type="text" class="form-control" id="kapasitas_mesin" name="kapasitas_mesin" required>
        </div>
        <div class="mb-3">
            <label for="tahun_produksi" class="form-label">Tahun Produksi</label>
            <input type="text" class="form-control" id="tahun_produksi" name="tahun_produksi" required>
        </div>
        <div class="mb-3">
            <label for="foto1" class="form-label">Foto 1</label>
            <input type="file" class="form-control" id="foto1" name="foto1" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="foto2" class="form-label">Foto 2</label>
            <input type="file" class="form-control" id="foto2" name="foto2" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="foto3" class="form-label">Foto 3</label>
            <input type="file" class="form-control" id="foto3" name="foto3" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control" id="stok" name="stok" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan Pelanggan</button>
        <a href="/motors" class="btn btn-danger">Kembali</a>

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
