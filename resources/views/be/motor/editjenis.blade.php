@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')

<div class="container mt-5">
    <h2>Update Jenis Motor : {{ $jenis_motor->name }} </h2>
    <form action="{{ route('jenis-motors.update', $jenis_motor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" value="{{ $jenis_motor->merk }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-control" id="jenis" name="jenis" required>
                <option value="Bebek" {{ $jenis_motor->jenis === 'Bebek' ? 'selected' : '' }}>Bebek</option>
                <option value="Skuter" {{ $jenis_motor->jenis === 'Skuter' ? 'selected' : '' }}>Skuter</option>
                <option value="Dual Sport" {{ $jenis_motor->jenis === 'Dual Sport' ? 'selected' : '' }}>Dual Sport</option>
                <option value="Naked Sport" {{ $jenis_motor->jenis === 'Naked Sport' ? 'selected' : '' }}>Naked Sport</option>
                <option value="Sport Bike" {{ $jenis_motor->jenis === 'Sport Bike' ? 'selected' : '' }}>Sport Bike</option>
                <option value="Retro" {{ $jenis_motor->jenis === 'Retro' ? 'selected' : '' }}>Retro</option>
                <option value="Cruiser" {{ $jenis_motor->jenis === 'Cruiser' ? 'selected' : '' }}>Cruiser</option>
                <option value="Sport Touring" {{ $jenis_motor->jenis === 'Sport Touring' ? 'selected' : '' }}>Sport Touring</option>
                <option value="Dirt Bike" {{ $jenis_motor->jenis === 'Dirt Bike' ? 'selected' : '' }}>Dirt Bike</option>
                <option value="Motocross" {{ $jenis_motor->jenis === 'Motocross' ? 'selected' : '' }}>Motocross</option>
                <option value="Scrambler" {{ $jenis_motor->jenis === 'Scrambler' ? 'selected' : '' }}>Scrambler</option>
                <option value="ATV" {{ $jenis_motor->jenis === 'ATV' ? 'selected' : '' }}>ATV</option>
                <option value="Motor Adventure" {{ $jenis_motor->jenis === 'Motor Adventure' ? 'selected' : '' }}>Motor Adventure</option>
                <option value="Lainnya" {{ $jenis_motor->jenis === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi_jenis" class="form-label">Deskripsi Jenis</label>
            <input type="text" class="form-control" id="deskripsi_jenis" name="deskripsi_jenis" value="{{ $jenis_motor->deskripsi_jenis }}" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image Url</label>
            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*" value="{{ $jenis_motor->image_url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Jenis Motor</button>
        <a href="{{ route('jenis-motors') }}" class="btn btn-danger">Back</a>
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
