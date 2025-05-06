<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Home | Datta able Dashboard Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Datta able is trending dashboard template made using Bootstrap 5 design framework. Datta able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="Codedthemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('be/assets/images/favicon.svg')}}" type="image/x-icon" />
 <!-- [Font] Family -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{asset('be/assets/fonts/tabler-icons.min.css')}}" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{asset('be/assets/fonts/feather.css')}}" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{asset('be/assets/fonts/fontawesome.css')}}" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{asset('be/assets/fonts/material.css')}}" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{asset('be/assets/css/style.css')}}" id="main-style-link" />
<link rel="stylesheet" href="{{asset('be/assets/css/style-preset.css')}}" />
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-14K1GBX9FG');
</script>
<!-- WiserNotify -->
<script>
  !(function () {
    if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
    else {
      window.t4hto4 = !0;
      var t = document,
        e = window,
        n = function () {
          var e = t.createElement('script');
          (e.type = 'text/javascript'),
            (e.async = !0),
            (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
            document.body.appendChild(e);
        };
      'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e.addEventListener('load', n, !1);
    }
  })();
</script>
<!-- Microsoft clarity -->
<script type="text/javascript">
  (function (c, l, a, r, i, t, y) {
    c[a] =
      c[a] ||
      function () {
        (c[a].q = c[a].q || []).push(arguments);
      };
    t = l.createElement(r);
    t.async = 1;
    t.src = 'https://www.clarity.ms/tag/' + i;
    y = l.getElementsByTagName(r)[0];
    y.parentNode.insertBefore(t, y);
  })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.carousel-img {
    height: 500px;           /* Set your desired height */
    object-fit: cover;       /* or 'contain' if you want the whole image visible */
    object-position: center; /* Center the image */
}

.carousel-img {
    height: 350px;
    max-width: 500px;
    margin: 0 auto;
    object-fit: cover;
    object-position: center;
}
</style>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- sidebar start -->
@yield('sidebar')

<!-- sidebar end -->


<!-- header start -->
@yield('header')

<!-- header end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="page-header-title">
                  <h5 class="mb-0">Home</h5>
                </div>
              </div>
              <div class="col-md-12">
                <ul class="breadcrumb mb-0">

                  @if(auth()->user()->role === 'admin')
                  <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                  @elseif(auth()->user()->role === 'marketing')
                  <li class="breadcrumb-item"><a href="/marketing">Marketing</a></li>
                  @elseif(auth()->user()->role === 'ceo')
                  <li class="breadcrumb-item"><a href="/ceo">CEO</a></li>
                  @endif
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                  <!-- <li class="breadcrumb-item" aria-current="page"></li> -->
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">

        <!-- Daily Sales start -->

        @yield('dailysales')
        <!-- Daily Sales end -->


        <!-- Monthly Sales start -->

        @yield('monthlysales')
        <!-- Monthly Sales end -->


        <!-- Yearly Sales start -->

        @yield('yearlysales')
        <!-- Yearly Sales end -->


        <!-- World Low start -->

        @yield('worldlow')
        <!-- World Low end -->


        <!-- Statistic Year start -->

        @yield('statisticyear')
        <!-- Statistic Year end -->


        <!-- Social Media start -->

        @yield('socialmedia')
        <!-- Social Media end -->


        <!-- Rating List start -->

        @yield('ratinglist')
        <!-- Rating List end -->


        <!-- Recent Users start -->

        @yield('recentusers')
        <!-- Recent Users end -->


        <!-- Table Users start -->

        @yield('users')
        <!-- Table Users end -->

        <!-- Create Users start -->

        @yield('usercreate')
        <!-- Create Users end -->

        <!-- Update Users start -->

        @yield('userupdate')
        <!-- Update Users end -->

        <!-- Table Pelanggans start -->

        @yield('pelanggans')
        <!-- Table Pelanggans end -->

        <!-- Create Pelanggans start -->

        @yield('pelanggancreate')
        <!-- Create Pelanggans end -->

        <!-- Update Pelanggans start -->

        @yield('pelangganupdate')
        <!-- Update Pelanggans end -->


        <!-- Content start -->

        @yield('content')
        <!-- Content end -->

        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0">Datta able &#9829; crafted by Team <a href="https://codedthemes.com/" target="_blank">Codedthemes</a></p>
          </div>
          <div class="col-auto my-1">
            <ul class="list-inline footer-link mb-0">
              <li class="list-inline-item"><a href="../index.html">Home</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>


    <!-- [Page Specific JS] start -->
    <!-- apexcharts js -->
    <script src="{{asset('be/assets/js/plugins/apexcharts.min.js')}}"></script>

    <script src="{{asset('be/assets/js/plugins/jsvectormap.min.js')}}"></script>
    <script src="{{asset('be/assets/js/plugins/world.js')}}"></script>

    <script src="{{asset('be/assets/js/pages/dashboard-default.js')}}"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{asset('be/assets/js/plugins/popper.min.js')}}"></script>
    <script src="{{asset('be/assets/js/plugins/simplebar.min.js')}}"></script>
    <script src="{{asset('be/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('be/assets/js/fonts/custom-font.js')}}"></script>
    <script src="{{asset('be/assets/js/script.js')}}"></script>
    <script src="{{asset('be/assets/js/theme.js')}}"></script>
    <script src="{{asset('be/assets/js/plugins/feather.min.js')}}"></script>



    <script>
      layout_change('light');
    </script>

    <script>
      change_box_container('false');
    </script>

    <script>
      layout_caption_change('true');
    </script>

    <script>
      layout_rtl_change('false');
    </script>

    <script>
      preset_change('preset-1');
    </script>

    <script>
      layout_theme_sidebar_change('false');
    </script>


  </body>
  <!-- [Body] end -->
</html>
