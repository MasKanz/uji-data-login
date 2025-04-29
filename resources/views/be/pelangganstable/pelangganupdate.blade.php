<div class="container mt-5">


    <h2>Update Pelanggan : {{ $pelanggan->name }} </h2>
    <form action="{{ route('pelanggans.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $pelanggan->email }}" required>
        </div>
        <div class="mb-3">
            <label for="katakunci" class="form-label">Password</label>
            <input type="password" class="form-control" id="katakunci" name="katakunci" placeholder="Kosongkan apabila tidak ingin mengganti password" autocomplete="new-katakunci">
            <small class="form-text text-muted">Kosongkan apabila tidak ingin mengganti password.</small>
        </div>
        <div class="mb-3">
            <label for="katakunci_confirmation" class="form-label" >Konfirmasi Password</label>
            <input type="password" class="form-control" id="katakunci_confirmation" name="katakunci_confirmation" placeholder="Kosongkan apabila tidak ingin mengganti password" autocomplete="new-password">
            <small class="form-text text-muted">Kosongkan apabila tidak ingin mengganti password.</small>
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $pelanggan->no_telp }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Pelanggan</button>
        <a href="{{ route('pelanggans') }}" class="btn btn-danger">Back</a>
    </form>
</div>


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
