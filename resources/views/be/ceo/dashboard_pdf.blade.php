<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard CEO - Ringkasan Laporan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .card { border:1px solid #ccc; border-radius:8px; padding:16px; margin-bottom:12px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 8px; }
        .value { font-size: 24px; }
        .row { display: flex; flex-wrap: wrap; }
        .col { flex: 1 0 40%; margin: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px;}
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; }
    </style>
</head>
<body>
    <h2>Dashboard CEO - Ringkasan Laporan</h2>
    <div class="row">
        <div class="col card">
            <div class="title">Total Pengajuan</div>
            <div class="value">{{ $totalPengajuan }}</div>
        </div>
        <div class="col card">
            <div class="title">Pengajuan Disetujui</div>
            <div class="value">{{ $pengajuanDisetujui }}</div>
        </div>
        <div class="col card">
            <div class="title">Pengajuan Ditolak</div>
            <div class="value">{{ $pengajuanDitolak }}</div>
        </div>
        <div class="col card">
            <div class="title">Pengiriman Berhasil</div>
            <div class="value">{{ $pengirimanBerhasil }}</div>
        </div>
        <div class="col card">
            <div class="title">Angsuran Lunas</div>
            <div class="value">{{ $angsuranLunas }}</div>
        </div>
        <div class="col card">
            <div class="title">Angsuran Belum Lunas</div>
            <div class="value">{{ $angsuranBelumLunas }}</div>
        </div>
        <div class="col card">
            <div class="title">Total Pendapatan Kredit</div>
            <div class="value">Rp {{ number_format($totalPendapatan,0,',','.') }}</div>
        </div>
        <div class="col card">
            <div class="title">Rata-rata Margin Kredit</div>
            <div class="value">{{ number_format($avgMargin * 100, 2) }}%</div>
        </div>
    </div>
    <h4>Tren Pengajuan per Bulan (12 bulan terakhir)</h4>
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Jumlah Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuanPerBulan as $row)
            <tr>
                <td>{{ $row->bulan }}</td>
                <td>{{ $row->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
