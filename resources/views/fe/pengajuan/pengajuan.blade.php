@extends('fe.master')
@section('navbar')
    @include('fe.components.navbar')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Ajukan Kredit Motor</h2>
    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_motor">Pilih Motor</label>
            <select name="id_motor" class="form-control" required>
                @foreach($motors as $motor)
                    <option value="{{ $motor->id }}" {{ request('id_motor') == $motor->id ? 'selected' : '' }}>
                        {{ $motor->nama_motor }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dp">DP (Down Payment)</label>
            <input type="number" name="dp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_jenis_cicilan">Tenor (bulan)</label>
            <select name="id_jenis_cicilan" class="form-control" required>
                @foreach($jenisCicilan as $cicilan)
                    <option value="{{ $cicilan->id }}">{{ $cicilan->lama_cicilan }} bulan (Bunga: {{ $cicilan->margin_kredit * 100 }}%)</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_asuransi">Pilih Asuransi</label>
            <select name="id_asuransi" class="form-control" required>
                @foreach($asuransiList as $asuransi)
                    <option value="{{ $asuransi->id }}">{{ $asuransi->nama_asuransi }} ({{ $asuransi->nama_perusahaan_asuransi }}, {{ $asuransi->margin_asuransi }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="url_kk">Upload KK</label>
            <input type="file" name="url_kk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="url_ktp">Upload KTP</label>
            <input type="file" name="url_ktp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="url_npwp">Upload NPWP</label>
            <input type="file" name="url_npwp" class="form-control">
        </div>
        <div class="mb-3">
            <label for="url_slip_gaji">Upload Slip Gaji</label>
            <input type="file" name="url_slip_gaji" class="form-control">
        </div>
        <div class="mb-3">
            <label for="url_foto">Upload Foto Diri</label>
            <input type="file" name="url_foto" class="form-control">
        </div>


        <!-- Rincian Kredit -->
        <div class="mb-3">
            <h5>Rincian Kredit</h5>
            <div id="rincian-kredit" class="border rounded p-3 bg-light">
                <div><b>Harga Motor Kredit:</b> <span id="harga-motor-kredit">-</span></div>
                <div><b>Pokok Kredit:</b> <span id="pokok-kredit">-</span></div>
                <div><b>Total Bunga:</b> <span id="total-bunga">-</span></div>
                <div><b>Total Kredit:</b> <span id="total-kredit">-</span></div>
                <div><b>Asuransi per Bulan:</b> <span id="asuransi-bulanan">-</span></div>
                <div><b>Total Asuransi:</b> <span id="total-asuransi">-</span></div>
                <div><b>Cicilan per Bulan:</b> <span id="cicilan-bulanan">-</span></div>
                <div><b>Total yang Harus Dibayar:</b> <span id="total-bayar">-</span></div>

                <script>
                    // Data motor, cicilan, dan asuransi dari backend (dalam bentuk JS object)
                    const motors = @json($motors->keyBy('id'));
                    const cicilans = @json($jenisCicilan->keyBy('id'));
                    const asuransiList = @json($asuransiList->keyBy('id'));

                    function formatRupiah(angka) {
                        return 'Rp ' + angka.toLocaleString('id-ID');
                    }

                    function hitungRincian() {
                        const idMotor = document.querySelector('[name="id_motor"]').value;
                        const dp = parseInt(document.querySelector('[name="dp"]').value) || 0;
                        const idCicilan = document.querySelector('[name="id_jenis_cicilan"]').value;
                        const idAsuransi = document.querySelector('[name="id_asuransi"]').value;

                        if (!motors[idMotor] || !cicilans[idCicilan] || !asuransiList[idAsuransi]) return;

                        const hargaCash = parseInt(motors[idMotor].harga_jual);
                        const tenor = parseInt(cicilans[idCicilan].lama_cicilan);
                        const bunga = parseFloat(cicilans[idCicilan].margin_kredit);
                        const marginAsuransi = parseFloat(asuransiList[idAsuransi].margin_asuransi);

                        // Kenaikan harga motor
                        let persentaseKenaikan = 0;
                        if (tenor <= 12) persentaseKenaikan = 0.05;
                        else if (tenor > 12 && tenor <= 24) persentaseKenaikan = 0.10;
                        else if (tenor > 24 && tenor <= 36) persentaseKenaikan = 0.15;

                        const hargaMotorKredit = hargaCash + (hargaCash * persentaseKenaikan);
                        const pokokKredit = hargaMotorKredit - dp;
                        const totalBunga = pokokKredit * bunga * (tenor / 12);
                        const totalKredit = pokokKredit + totalBunga;
                        const cicilanPerBulan = totalKredit / tenor;
                        const asuransiPerBulan = hargaMotorKredit * marginAsuransi / tenor;
                        const totalAsuransi = asuransiPerBulan * tenor;
                        const totalBayar = totalKredit + totalAsuransi;

                        document.getElementById('harga-motor-kredit').innerText = formatRupiah(hargaMotorKredit);
                        document.getElementById('pokok-kredit').innerText = formatRupiah(pokokKredit);
                        document.getElementById('total-bunga').innerText = formatRupiah(totalBunga);
                        document.getElementById('total-kredit').innerText = formatRupiah(totalKredit);
                        document.getElementById('asuransi-bulanan').innerText = formatRupiah(asuransiPerBulan);
                        document.getElementById('total-asuransi').innerText = formatRupiah(totalAsuransi);
                        document.getElementById('cicilan-bulanan').innerText = formatRupiah(cicilanPerBulan);
                        document.getElementById('total-bayar').innerText = formatRupiah(totalBayar);
                    }

                    // Event listener
                    document.querySelector('[name="id_motor"]').addEventListener('change', hitungRincian);
                    document.querySelector('[name="dp"]').addEventListener('input', hitungRincian);
                    document.querySelector('[name="id_jenis_cicilan"]').addEventListener('change', hitungRincian);
                    document.querySelector('[name="id_asuransi"]').addEventListener('change', hitungRincian);

                    // Hitung awal jika data sudah terisi
                    window.addEventListener('DOMContentLoaded', hitungRincian);
                </script>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Kredit</button>
        <a href="{{ route('products') }}" class="btn btn-secondary">Kembali ke Produk-Produk</a>

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
