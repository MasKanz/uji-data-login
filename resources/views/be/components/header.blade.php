<!-- [ Header Topbar ] start -->
<style>
.border-left-4 {
  border-left: 4px solid #ffc107 !important;
}
.btn-xs {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}
</style>
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse">
      <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
        <i data-feather="menu"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
        <i data-feather="menu"></i>
      </a>
    </li>
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i data-feather="search"></i>
      </a>
      <div class="dropdown-menu pc-h-dropdown drp-search">
        <form class="px-3 py-2">
          <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
        </form>
      </div>
    </li>
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i data-feather="bell"></i>
        @php
          $adminNotif = collect();
          $adminNotifCount = 0;
          if(auth()->check() && auth()->user()->role === 'admin') {
            $adminNotif = \App\Models\AdminNotifikasi::where('dibaca', false)
              ->with(['pengajuan', 'kredit.angsuran', 'kredit.pengajuanKredit.pelanggan', 'pelanggan'])
              ->orderBy('created_at', 'desc')
              ->limit(5)
              ->get();
            $adminNotifCount = \App\Models\AdminNotifikasi::where('dibaca', false)->count();
          }
        @endphp
        <span class="badge bg-success pc-h-badge">{{ $adminNotifCount > 0 ? $adminNotifCount : '0' }}</span>
      </a>
      <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
          <h5 class="m-0">Notifikasi</h5>
          @if($adminNotifCount > 0)
          <a href="#!" class="btn btn-link btn-sm" id="markAllNotifRead">Tandai semua dibaca</a>
          @endif
        </div>
        <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
          @if($adminNotif->count() > 0)
            <p class="text-span">Pengajuan Terbaru</p>
            @foreach($adminNotif as $notif)
            <div class="card mb-0 @if(!$notif->dibaca) border-left-4 border-warning @endif">
              <div class="card-body">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <div class="avtar @if($notif->tipe === 'pengajuan') bg-warning @elseif($notif->tipe === 'pembayaran') bg-success @else bg-info @endif">
                      @if($notif->tipe === 'pengajuan')
                        <i class="fas fa-file-contract"></i>
                      @elseif($notif->tipe === 'pembayaran')
                        <i class="fas fa-money-bill-wave"></i>
                      @else
                        <i class="fas fa-truck"></i>
                      @endif
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <span class="float-end text-sm text-muted">{{ $notif->created_at->diffForHumans() }}</span>
                    <h5 class="text-body mb-2">{{ $notif->judul }}</h5>
                    <p class="mb-1" style="font-size: 0.85rem;">
                      {{ Str::limit($notif->pesan, 60) }}
                    </p>
                    <div class="mt-2">
                      @if(!$notif->dibaca)
                      <form action="{{ route('admin.mark-notifikasi', $notif->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="btn btn-xs btn-success" type="submit">
                          <i class="fas fa-check"></i> Dibaca
                        </button>
                      </form>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>

            @endforeach
          @else
            <div class="text-center py-4">
              <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
              <p class="text-muted mt-2">Tidak ada notifikasi baru</p>
            </div>
          @endif
        </div>
        @if($adminNotif->count() > 0)
        <div class="text-center py-2">
          <a href="/admin" class="link-primary">Lihat semua notifikasi</a>
        </div>
        @endif
      </div>
    </li>
    <li class="dropdown pc-h-item header-user-profile">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        data-bs-auto-close="outside"
        aria-expanded="false"
      >
        <i data-feather="user"></i>
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-0 overflow-hidden">
        <div class="dropdown-header d-flex align-items-center justify-content-between bg-primary">
          <div class="d-flex my-2">
            <div class="flex-shrink-0">
              <img src="{{asset('be/assets/images/user/avatar-2.jpg')}}" alt="user-image" class="user-avtar wid-35" />
            </div>
            <div class="flex-grow-1 ms-3">
              <h6 class="text-white mb-1">{{ Auth::user()->name }} 🖖</h6>
              <span class="text-white text-opacity-75">{{ Auth::user()->email }}</span>
            </div>
          </div>
        </div>
        <div class="dropdown-body">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-setting-outline"></use>
                </svg>
                <span>Settings</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-share-bold"></use>
                </svg>
                <span>Share</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-lock-outline"></use>
                </svg>
                <span>Change Password</span>
              </span>
            </a>
            <form method="POST" action="{{ url('/logout') }}">
            <div class="d-grid my-2">
            @csrf
              <button class="btn btn-primary logout" type="submit">
                <svg class="pc-icon me-2">
                  <use xlink:href="#custom-logout-1-outline"></use></svg>
                Logout
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
 </div>
</header>
<!-- [ Header ] end -->
