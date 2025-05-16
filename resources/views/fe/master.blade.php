<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Vesperr Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('fe/img/favicon.png')}}" rel="icon">
  <link href="{{asset('fe/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('fe/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('fe/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('fe/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('fe/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('fe/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('fe/css/main.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

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

<body class="index-page">

@yield('navbar')


  <main class="main">

  @if($title === 'Home')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Kredit motor gampang dengan KA-redit</h1>
            <p>Mau kredit motor? Di sini aja tempatnya</p>
            <div class="d-flex">
              <a href="{{ route('products') }}" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="{{asset('fe/img/motorbike-hero.jpg')}}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/2560px-Yamaha_Motor_Logo_(full).svg.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/Honda_Logo.svg.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/Kawasaki_Logo.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/Vespa_Logo.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/Suzuki_Logo.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{asset('fe/img/clients/TVS_Logo.png')}}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

        </div>

      </div>

    </section><!-- /Clients Section -->

        <!-- Carousel Motor -->

<div class="d-flex flex-row">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 500px; width: 50%;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100"  src="{{asset('fe/img/motor/Aerox_Alpha.png')}}" alt="First slide" width="500px important" height="500px" scale="30%">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100"  src="{{asset('fe/img/motor/Honda_Beat_Sporty.jpg')}}" alt="Second slide" width="500px important" height="500px" scale="30%">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('fe/img/motor/Kawasaki_W230.png')}}" alt="Third slide" width="500px important" scale="30%">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<div style="width: 40%; padding:50px;" class="title-new-motor">
    <h1>Motor Terbaru</h1>
    <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque minus perferendis ab. Rerum, ad! Minus at voluptas, nulla dolor rem debitis saepe laborum repellendus. Perspiciatis totam asperiores fuga dignissimos dolorum.
    </p>
</div>


</div>
    <!-- /Carouser Motor -->

@endif

@yield('about')

    @yield('features')

    @yield('testimonies')

    <!-- Portfolio Section -->

@yield('portfolio')

    <!-- /Portfolio Section -->


    <!-- Profile -->
@yield('profile')
    <!-- /Profile -->


    @yield('faq')

    @yield('contact')

    @yield('update')

    @yield('content')


  </main>


  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Vesperr</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('fe/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('fe/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('fe/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('fe/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('fe/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('fe/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('fe/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('fe/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('fe/js/main.js')}}"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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

    @if(session('notif_pengajuan_batal'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Pengajuan Kredit Dibatalkan',
            html: `<b>Alasan:</b> {{ session('notif_pengajuan_batal.alasan') }}`,
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


</body>

</html>
