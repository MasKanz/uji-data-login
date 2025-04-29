<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<section class="" style="background-color: #508bfc;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign Up</h3>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form method="POST" action="{{ url('/daftar') }}">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4"><input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control form-control-lg" placeholder="Nama" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="password" id="katakunci" name="katakunci" class="form-control form-control-lg" placeholder="Password" required autocomplete="new-password"/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="password" id="katakunci_confirmation" name="katakunci_confirmation" class="form-control form-control-lg" placeholder=" Konfirmasi Password" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="text" id="no_telp" name="no_telp" class="form-control form-control-lg" placeholder="Nomor Telepon" required/></div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block px-5" type="submit">Register</button>

            </form>

            <hr class="my-4">

            <div style="border: solid 1px black; padding:10px 10px; border-radius: 20px;">
              <p class="mb-0">Sudah Punya Akun? <a href="/masuk" class="text-black-50 fw-bold">Sign in</a>
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
