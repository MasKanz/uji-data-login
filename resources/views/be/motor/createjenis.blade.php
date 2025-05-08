@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Tambahkan Jenis Motor Baru</h2>
    <form action="{{ route('jenis-motors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
            <option value="Bebek">Bebek</option>
            <option value="Skuter">Skuter</option>
            <option value="Dual Sport">Dual Sport</option>
            <option value="Naked Sport">Naked Sport</option>
            <option value="Sport Bike">Sport Bike</option>
            <option value="Retro">Retro</option>
            <option value="Cruiser">Cruiser</option>
            <option value="Sport Touring">Sport Touring</option>
            <option value="Dirt Bike">Dirt Bike</option>
            <option value="Motocross">Motocross</option>
            <option value="Scrambler">Scrambler</option>
            <option value="ATV">ATV</option>
            <option value="Motor Adventure">Motor Adventure</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi_jenis" class="form-label">Deskripsi Jenis</label>
            <input type="textarea" class="form-control" id="deskripsi_jenis" name="deskripsi_jenis" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image Url</label>
            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan Jenis Motor</button>
        <a href="/jenis_motors" class="btn btn-danger">Kembali</a>

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
