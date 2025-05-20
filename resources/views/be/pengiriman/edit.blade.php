@extends('be.master')
@section('header')
    @include('be.components.header')
@endsection
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('content')
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
<div class="container mt-5">
    <h2>Edit Pengiriman</h2>
    <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="no_invoice" class="form-label">No Invoice</label>
            <input type="text" name="no_invoice" class="form-control" value="{{ old('no_invoice', $pengiriman->no_invoice) }}" required>
        </div>
        <div class="mb-3">
            <label for="tgl_kirim" class="form-label">Tanggal Kirim</label>
            <input type="date" name="tgl_kirim" class="form-control" value="{{ old('tgl_kirim', $pengiriman->tgl_kirim ? date('Y-m-d\TH:i', strtotime($pengiriman->tgl_kirim)) : '') }}" required>
        </div>
        <div class="mb-3">
            <label for="tgl_tiba" class="form-label">Tanggal Tiba</label>
            <input type="date" name="tgl_tiba" class="form-control" value="{{ old('tgl_tiba', $pengiriman->tgl_tiba ? date('Y-m-d\TH:i', strtotime($pengiriman->tgl_tiba)) : '') }}">
        </div>
        <div class="mb-3">
            <label for="status_kirim" class="form-label">Status Kirim</label>
            <select name="status_kirim" class="form-control" required>
                <option value="Sedang Dikirim" {{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                <option value="Tiba Di Tujuan" {{ $pengiriman->status_kirim == 'Tiba Di Tujuan' ? 'selected' : '' }}>Tiba Di Tujuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_kurir" class="form-label">Nama Kurir</label>
            <input type="text" name="nama_kurir" class="form-control" value="{{ old('nama_kurir', $pengiriman->nama_kurir) }}" required>
        </div>
        <div class="mb-3">
            <label for="telpon_kurir" class="form-label">Telpon Kurir</label>
            <input type="text" name="telpon_kurir" class="form-control" value="{{ old('telpon_kurir', $pengiriman->telpon_kurir) }}" required>
        </div>
        <div class="mb-3">
            <label for="bukti_foto" class="form-label">Bukti Foto (opsional)</label>
            <input type="file" name="bukti_foto" class="form-control">
            @if($pengiriman->bukti_foto)
                <a href="{{ asset('storage/' . $pengiriman->bukti_foto) }}" target="_blank">Lihat Foto Saat Ini</a>
            @endif
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $pengiriman->keterangan) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Pengiriman</button>
        <a href="{{ route('pengiriman') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
