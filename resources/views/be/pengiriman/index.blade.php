@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
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
    <h2>Daftar Pengiriman</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>No Invoice</th>
                <th>Motor</th>
                <th>Pelanggan</th>
                <th>Tanggal Kirim</th>
                <th>Status</th>
                <th>Kurir</th>
                <th>Telpon Kurir</th>
                <th>Bukti Foto</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengirimanList as $pengiriman)
            <tr>
                <td>{{ $loop->iteration + ($pengirimanList->firstItem() - 1) }}</td>
                <td>{{ $pengiriman->no_invoice }}</td>
                <td>{{ $pengiriman->kredit->pengajuanKredit->motor->nama_motor ?? '-' }}</td>
                <td>{{ $pengiriman->kredit->pengajuanKredit->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $pengiriman->tgl_kirim }}</td>
                <td>
                    <span class="badge bg-{{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'warning' : 'success' }}">
                        {{ $pengiriman->status_kirim }}
                    </span>
                </td>
                <td>{{ $pengiriman->nama_kurir }}</td>
                <td>{{ $pengiriman->telpon_kurir }}</td>
                <td>
                    @if($pengiriman->bukti_foto)
                        <a href="{{ asset('storage/' . $pengiriman->bukti_foto) }}" target="_blank">Lihat Foto</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $pengiriman->keterangan }}</td>
                <td>
                    <a href="{{ route('pengiriman.show', $pengiriman->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengiriman ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pengirimanList->links() }}
</div>
@endsection
