<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>
<body>

<!-- <div class="container">
    <h2>Register</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="marketing">Marketing</option>
            <option value="ceo">CEO</option>
        </select>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
</div> -->

<section class="" style="background-color:rgb(14, 231, 119);">
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

            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4"><input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Nama" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required autocomplete="new-password"/></div>
                <div data-mdb-input-init class="form-outline mb-4"><input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder=" Konfirmasi Password" required/></div>
                <div data-mdb-input-init class="form-outline mb-4"><select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="marketing">Marketing</option>
                    <option value="ceo">CEO</option>
                </select></div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block px-5" type="submit">Register</button>

            </form>

            <hr class="my-4">

            <div style="border: solid 1px black; padding:10px 10px; border-radius: 20px;">
              <p class="mb-0">Sudah Punya Akun? <a href="{{ url('/login') }}" class="text-black-50 fw-bold">Sign in</a>
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
