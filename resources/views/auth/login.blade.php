<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>
<body>

<!-- <div class="container">
    <h2>Login</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
        @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a></p>
</div> -->



<section class="vh-100" style="background-color:rgb(14, 231, 119);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required/>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" autocomplete="new-password"/>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror


            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block px-5" type="submit">Login</button>


            </form>

            <hr class="my-4">

            <div style="border: solid 1px black; padding:10px 10px; border-radius: 20px;">
              <p class="mb-0">Belum Punya Akun? <a href="{{ url('/register') }}" class="text-black-50 fw-bold">Sign Up</a>
              </p>
            </div>

            <div style="padding:10px 10px; border-radius: 20px;">
              <p class="mb-0"><a href="/" class="text-black-50 fw-bold">Kembali</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>
