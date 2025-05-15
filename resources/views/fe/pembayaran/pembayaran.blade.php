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
                    {{ $kredit->pengajuanKredit->motor->nama_motor ?? '-' }} -
                    Sisa: Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }} -
                    Cicilan per Bulan: Rp{{ number_format($kredit->pengajuanKredit->cicilan_perbulan ?? 0, 0, ',', '.') }}
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
    <div class="mb-3">
        <h5>Rincian Setelah Pembayaran</h5>
        <div id="rincian-sisa" class="border rounded p-3 bg-light">
            <div><b>Sisa Kredit Sebelum Bayar:</b> <span id="sisa-sebelum">-</span></div>
            <div><b>Nominal Pembayaran:</b> <span id="nominal-bayar">-</span></div>
            <div><b>Sisa Kredit Setelah Bayar:</b> <span id="sisa-setelah">-</span></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Bayar</button>
</form>
</div>

<script>
    // Data kredit dari backend
    const kreditData = {!! json_encode($kredits->keyBy('id')) !!};

    function formatRupiah(angka) {
        return 'Rp ' + (angka ? angka.toLocaleString('id-ID') : '0');
    }

    function updateRincian() {
        const idKredit = document.querySelector('[name="id_kredit"]').value;
        const kredit = kreditData[idKredit];
        const sisaKredit = kredit ? kredit.sisa_kredit : 0;
        const bayar = parseInt(document.querySelector('[name="total_bayar"]').value) || 0;

        document.getElementById('sisa-sebelum').innerText = formatRupiah(sisaKredit);
        document.getElementById('nominal-bayar').innerText = formatRupiah(bayar);
        document.getElementById('sisa-setelah').innerText = formatRupiah(Math.max(sisaKredit - bayar, 0));
    }

    document.querySelector('[name="id_kredit"]').addEventListener('change', updateRincian);
    document.querySelector('[name="total_bayar"]').addEventListener('input', updateRincian);

    window.addEventListener('DOMContentLoaded', updateRincian);
</script>
@endsection
