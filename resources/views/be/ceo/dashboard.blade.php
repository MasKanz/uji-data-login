@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Dashboard CEO - Ringkasan Laporan</h2>
    <a href="{{ route('ceo.dashboard.pdf') }}" class="btn btn-danger mb-3" target="_blank">
        <i class="fa fa-file-pdf"></i> Download PDF Ringkasan
    </a>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pengajuan</div>
                <div class="card-body"><h3>{{ $totalPengajuan }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Pengajuan Disetujui</div>
                <div class="card-body"><h3>{{ $pengajuanDisetujui }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Pengajuan Ditolak</div>
                <div class="card-body"><h3>{{ $pengajuanDitolak }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Pengiriman Berhasil</div>
                <div class="card-body"><h3>{{ $pengirimanBerhasil }}</h3></div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Angsuran Lunas</div>
                <div class="card-body"><h3>{{ $angsuranLunas }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Angsuran Belum Lunas</div>
                <div class="card-body"><h3 style="color: white;">{{ $angsuranBelumLunas }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Pendapatan Kredit</div>
                <div class="card-body"><h3>Rp {{ number_format($totalPendapatan,0,',','.') }}</h3></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Rata-rata Margin Kredit</div>
                <div class="card-body"><h3 style="color: white;">{{ number_format($avgMargin * 100, 2) }}%</h3></div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <canvas id="piePengajuan"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="pieAngsuran"></canvas>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <canvas id="linePengajuan"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart Pengajuan
    new Chart(document.getElementById('piePengajuan'), {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Ditolak'],
            datasets: [{
                data: [{{ $pengajuanDisetujui }}, {{ $pengajuanDitolak }}],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        },
        options: { responsive: true }
    });

    // Pie Chart Angsuran
    new Chart(document.getElementById('pieAngsuran'), {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Belum Lunas'],
            datasets: [{
                data: [{{ $angsuranLunas }}, {{ $angsuranBelumLunas }}],
                backgroundColor: ['#ffc107', '#6c757d']
            }]
        },
        options: { responsive: true }
    });

    // Line Chart Pengajuan per Bulan
    new Chart(document.getElementById('linePengajuan'), {
        type: 'line',
        data: {
            labels: {!! json_encode($pengajuanPerBulan->pluck('bulan')) !!},
            datasets: [{
                label: 'Pengajuan per Bulan',
                data: {!! json_encode($pengajuanPerBulan->pluck('total')) !!},
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
