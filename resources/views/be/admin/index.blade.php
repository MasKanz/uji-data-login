@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Dashboard Admin - Ringkasan Laporan</h2>

    <!-- Notifikasi Pengajuan Baru -->
    @if($totalNotifikasiBelumDibaca > 0)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fa fa-bell"></i> <strong>{{ $totalNotifikasiBelumDibaca }} Notifikasi Baru!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Widget Notifikasi Pengajuan Baru -->
    @if(count($notifikasiPengajuanBaru) > 0)
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fa fa-exclamation-circle"></i> Pengajuan Kredit Baru</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        {{-- @foreach($notifikasiPengajuanBaru as $notif) --}}
                        <!-- <div class="list-group-item list-group-item-action @if(!$notif->dibaca) bg-light @endif">
                            <div class="d-flex w-100 justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $notif->judul }}</h6>
                                    <p class="mb-1 text-muted">{{ $notif->pesan }}</p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock"></i> {{ $notif->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div>
                                    @if(!$notif->dibaca)
                                    <form action="{{ route('admin.mark-notifikasi', $notif->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="btn btn-sm btn-primary" type="submit">Tandai Dibaca</button>
                                    </form>
                                    @else
                                    <span class="badge bg-success">Dibaca</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="javascript:void(0)" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailPengajuan{{ $notif->id }}">
                                    <i class="fa fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div> -->

                        <!-- Modal Detail -->
                        <!-- <div class="modal fade" id="detailPengajuan{{ $notif->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pengajuan Kredit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p><strong>Nama Pelanggan:</strong> {{ $notif->pelanggan->nama_pelanggan }}</p>
                                                <p><strong>Motor:</strong> {{ $notif->pengajuan->motor->nama_motor }}</p>
                                                <p><strong>Harga Motor:</strong> Rp {{ number_format($notif->pengajuan->harga_cash, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>DP:</strong> Rp {{ number_format($notif->pengajuan->dp, 0, ',', '.') }}</p>
                                                <p><strong>Cicilan/Bulan:</strong> Rp {{ number_format($notif->pengajuan->cicilan_perbulan, 0, ',', '.') }}</p>
                                                <p><strong>Status:</strong> <span class="badge bg-warning">{{ $notif->pengajuan->status_pengajuan }}</span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <p><strong>Tanggal Pengajuan:</strong> {{ $notif->pengajuan->tgl_pengajuan_kredit->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <a href="/pengajuan/{{ $notif->pengajuan->id }}/edit" class="btn btn-primary">Proses Pengajuan</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

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
