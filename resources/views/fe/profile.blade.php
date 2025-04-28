<section>

<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <h4>Profile</h4>
        <p> <ul>
            <li><p>Nama: {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p></li>
            <li><p>Email: {{ Auth::guard('pelanggan')->user()->email }}</p></li>
            <li><p>No. Telp: {{ Auth::guard('pelanggan')->user()->no_telp }}</p></li>
            <li><p>Alamat 1: {{ Auth::guard('pelanggan')->user()->alamat1 }}</p></li>
            <li><p>Kota 1: {{ Auth::guard('pelanggan')->user()->kota1 }}</p></li>
            <li><p>Provinsi 1: {{ Auth::guard('pelanggan')->user()->propinsi1 }}</p></li>
            <li><p>Kodepos 1: {{ Auth::guard('pelanggan')->user()->kodepos1 }}</p></li>

            <li><p>Alamat 2: {{ Auth::guard('pelanggan')->user()->alamat2 }}</p></li>
            <li><p>Kota 2: {{ Auth::guard('pelanggan')->user()->kota2 }}</p></li>
            <li><p>Provinsi 2: {{ Auth::guard('pelanggan')->user()->propinsi2 }}</p></li>
            <li><p>Kodepos 2: {{ Auth::guard('pelanggan')->user()->kodepos2 }}</p></li>

            <li><p>Alamat 3: {{ Auth::guard('pelanggan')->user()->alamat3 }}</p></li>
            <li><p>Kota 3: {{ Auth::guard('pelanggan')->user()->kota3 }}</p></li>
            <li><p>Provinsi 3: {{ Auth::guard('pelanggan')->user()->propinsi3 }}</p></li>
            <li><p>Kodepos 3: {{ Auth::guard('pelanggan')->user()->kodepos3 }}</p></li>

            <li>Foto: <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto Pelanggan" width="200"></li>
        </ul> </p>
</div>




<div class="button-container" data-aos="fade-up">
    <form method="POST" action="{{ url('/keluar') }}">
    @csrf
    <button type="submit" class="btn btn-danger keluar">Logout</button>
    </form>
</div>


</section>
