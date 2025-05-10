@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Pembayaran Angsuran</h2>
    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_kredit">Pilih Kredit</label>
            <select name="id_kredit" class="form-control" required>
                @foreach($kredits as $kredit)
                    <option value="{{ $kredit->id }}">
                        {{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }} - Sisa: Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="total_bayar">Nominal Pembayaran</label>
            <input type="number" name="total_bayar" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="bukti_bayar">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_bayar" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>
</div>
@endsection
