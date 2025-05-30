
<header id="header" class="header d-flex align-items-center sticky-top" style="background: linear-gradient(168deg, rgba(226, 226, 226, 0.97) 0%, rgba(247,247,247,1) 23%, rgba(255,255,255,1) 91%); width: 100%;">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/home" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">KA-redit</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
        <li><a href="/" @if($title === 'Home') class="active" @endif>Beranda<br></a></li>
        <li><a href="/shop"  @if($title === 'Shop') class="active" @endif>Produk</a></li>
        <li><a href="/pengajuan"  @if($title === 'Pengajuan') class="active" @endif>Pengajuan Kredit</a></li>
        <li><a href="/pembayaran"  @if($title === 'Pembayaran') class="active" @endif>Pembayaran</a></li>
        @php
            $notifs = \App\Models\Notifikasi::where('id_pelanggan', Auth::guard('pelanggan')->id())
                ->orderByDesc('created_at')->take(10)->get();
            $unreadCount = $notifs->where('dibaca', false)->count();
        @endphp
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-bell"></i>
                @if($unreadCount > 0)
                    <span class="badge bg-danger">{{ $unreadCount }}</span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end notif-dropdown" aria-labelledby="notifDropdown" style="width: 320px; max-width: 95vw;">
                <li class="dropdown-header">Notifikasi</li>
                @foreach($notifs as $notif)
                <li class="dropdown-item{{ $notif->dibaca ? '' : ' fw-bold' }}">
                    <div>{{ $notif->judul }}</div>
                    <small>{{ $notif->pesan }}</small>
                    <br>
                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    @if(!$notif->dibaca)
                        <form action="{{ route('notifikasi.read', $notif->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-sm p-0 text-primary">Read</button>
                        </form>
                    @endif
                </li>
            @endforeach
            </ul>
        </li>
        <!-- <li><a href="/abouts"  @if($title === 'Abouts') class="active" @endif>About</a></li> -->
        <!-- <li><a href="/contacts"  @if($title === 'Contacts') class="active" @endif>Contact</a></li> -->

          <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
        </li> -->
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @if(Auth::guard('pelanggan')->check())
    <div class="btn-group" style="padding: 0 10px 0 10px;">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        @if(Auth::guard('pelanggan')->user()->foto)
        <img src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}" alt="Foto Pelanggan" width="30" style="border-radius: 50%">
        @else
        {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}
        @endif
  </button>
  <ul class="dropdown-menu">
    <li style="text-align: center;"><img src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}" alt="Foto Pelanggan" width="100" style="border-radius: 10%;"></li>
    <li><a class="dropdown-item" href="/profilepelanggan">Halaman Profile</a></li>
    <li><a class="dropdown-item" href="/updatepelanggan">Lengkapi Alamat</a></li>
    <li><a class="dropdown-item" href="/pengajuan-saya">Daftar Pengajuan</a></li>
    <li><a class="dropdown-item" href="/kredit-saya">Daftar Kredit</a></li>
    <li><a class="dropdown-item" href="/pembayaran-saya">Daftar Pembayaran</a></li>
    <li><a class="dropdown-item" href="/pengiriman-saya">Daftar Pengiriman</a></li>
    <li><hr class="dropdown-divider"></li>
    <li style="text-align: center;">
      <form method="POST" action="{{ url('/keluar') }}">
        @csrf
        <button type="submit" class="btn btn-danger keluar" style="width: 80%;">Logout</button>
    </form>
    </li>

  </ul>
</div>
    @else
    <a class="btn-getstarted" href="/masuk">Login / Register</a>
    @endif

    </div>
  </header>
