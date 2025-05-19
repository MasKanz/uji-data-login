<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
      <div class="m-header">

        @if (auth()->user()->role == 'admin')
      <a href="/admin" class="b-brand text-primary">
<!-- ========   Change your logo from here   ============ -->
        <h3 style="color: white;">KA-redit</h3>
        <!-- <img src="{{asset('be/assets/images/logo-white.svg')}}" class="img-fluid logo-lg" alt="logo" /> -->
      </a>
        @elseif (auth()->user()->role == 'ceo')
      <a href="/admin" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <h3 style="color: white;">KA-redit</h3>
        <!-- <img src="{{asset('be/assets/images/logo-white.svg')}}" class="img-fluid logo-lg" alt="logo" /> -->
        @elseif (auth()->user()->role == 'marketing')
      <a href="/marketing" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <h3 style="color: white;">KA-redit</h3>
        <!-- <img src="{{asset('be/assets/images/logo-white.svg')}}" class="img-fluid logo-lg" alt="logo" /> -->
        @endif

    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigation</label>
        </li>
        @if (auth()->user()->role == 'admin')
        <li class="pc-item">
          <a href="/admin" class="pc-link">
            <span class="pc-micon">
              <i data-feather="home"></i>
            </span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/users" class="pc-link">
            <span class="pc-micon">
              <i data-feather="user"></i>
            </span>
            <span class="pc-mtext">User Management</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/pelanggans" class="pc-link">
            <span class="pc-micon">
              <i data-feather="users"></i>
            </span>
            <span class="pc-mtext">Pelanggan Management</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/motors" class="pc-link">
            <span class="pc-micon">
              <i data-feather="shopping-cart"></i>
            </span>
            <span class="pc-mtext">Motor Management</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/jenis-motors" class="pc-link">
            <span class="pc-micon">
              <i data-feather="slack"></i>
            </span>
            <span class="pc-mtext">Jenis Motor Management</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/jenis-cicilan" class="pc-link">
            <span class="pc-micon">
              <i data-feather="list"></i>
            </span>
            <span class="pc-mtext">Jenis Cicilan Management</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/asuransi" class="pc-link">
            <span class="pc-micon">
              <i data-feather="file-text"></i>
            </span>
            <span class="pc-mtext">Asuransi Management</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/pengajuan-kredit" class="pc-link">
            <span class="pc-micon">
              <i data-feather="inbox"></i>
            </span>
            <span class="pc-mtext">Pengajuan Management</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/kredit" class="pc-link">
            <span class="pc-micon">
              <i data-feather="file"></i>
            </span>
            <span class="pc-mtext">Kredit Management</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/metode-bayar" class="pc-link">
            <span class="pc-micon">
              <i data-feather="credit-card"></i>
            </span>
            <span class="pc-mtext">Metode Pembayaran</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/angsuran-verifikasi" class="pc-link">
            <span class="pc-micon">
              <i data-feather="credit-card"></i>
            </span>
            <span class="pc-mtext">Angsuran Verifikasi</span>
          </a>
        </li>

        <li class="pc-item">
          <a href="/pengiriman" class="pc-link">
            <span class="pc-micon">
              <i data-feather="credit-card"></i>
            </span>
            <span class="pc-mtext">Pengiriman</span>
          </a>
        </li>


        @elseif (auth()->user()->role == 'ceo')
        <li class="pc-item">
          <a href="/ceo" class="pc-link">
            <span class="pc-micon">
              <i data-feather="home"></i>
            </span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>



        @elseif (auth()->user()->role == 'marketing')
        <li class="pc-item">
          <a href="/marketing" class="pc-link">
            <span class="pc-micon">
              <i data-feather="home"></i>
            </span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/pengajuan-kredit" class="pc-link">
            <span class="pc-micon">
              <i data-feather="inbox"></i>
            </span>
            <span class="pc-mtext">Pengajuan Management</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/kredit" class="pc-link">
            <span class="pc-micon">
              <i data-feather="file"></i>
            </span>
            <span class="pc-mtext">Kredit Management</span>
          </a>
        </li>


        <li class="pc-item">
          <a href="/angsuran-verifikasi" class="pc-link">
            <span class="pc-micon">
              <i data-feather="credit-card"></i>
            </span>
            <span class="pc-mtext">Angsuran Verifikasi</span>
          </a>
        </li>
        @endif


      </ul>
      <!-- <div class="card pc-user-card my-3 bg-white bg-opacity-10">
        <div class="card-body text-center">
          <img src="{{asset('be/assets/images/application/img-coupon.png')}}" alt="img" class="img-fluid w-50" />
          <h5 class="mb-0 text-white mt-1">Datta Able</h5>
          <p class="text-white">Checkout pro features</p>
          <a href="https://codedthemes.com/item/datta-able-bootstrap-admin-template/" target="_blank" class="btn btn-warning">
            <svg class="pc-icon me-2">
              <use xlink:href="#custom-logout-1-outline"></use>
            </svg>
            Upgrade to Pro
          </a>
        </div>
      </div> -->
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->
