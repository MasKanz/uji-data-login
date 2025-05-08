<section>

    <h4>Profile</h4>
<div class="d-flex" data-aos="fade-up" data-aos-delay="200">
        <!-- <p> <ul>
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
            <li><p>Kodepos 3: {{ Auth::guard('pelanggan')->user()->kodepos3 }}</p></li> -->


            <div style="display: flex; width:100%">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Info</th>
                                <th>Alamat 1</th>
                                <th>Alamat 2</th>
                                <th>Alamat 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><p><strong>ID:</strong> {{ $pelanggan->id }}</p></td>
                                <td><p><strong>Alamat 1:</strong> {{ $pelanggan->alamat1 }}</p></td>
                                <td><p><strong>Alamat 2:</strong> {{ $pelanggan->alamat2 }}</p></td>
                                <td><p><strong>Alamat 3:</strong> {{ $pelanggan->alamat3 }}</p></td>
                            </tr>
                            <tr>
                                <td><p><strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}</p></td>
                                <td><p><strong>Kota 1:</strong> {{ $pelanggan->kota1 }}</p></td>
                                <td><p><strong>Kota 2:</strong> {{ $pelanggan->kota2 }}</p></td>
                                <td><p><strong>Kota 3:</strong> {{ $pelanggan->kota3 }}</p></td>
                            </tr>
                            <tr>
                                <td><p><strong>Email:</strong> {{ $pelanggan->email }}</p></td>
                                <td><p><strong>Provinsi 1:</strong> {{ $pelanggan->propinsi1 }}</p></td>
                                <td><p><strong>Provinsi 2:</strong> {{ $pelanggan->propinsi2 }}</p></td>
                                <td><p><strong>Provinsi 3:</strong> {{ $pelanggan->propinsi3 }}</p></td>
                            </tr>
                            <tr>
                                <td><p><strong>No. Telepon:</strong> {{ $pelanggan->no_telp }}</p></td>
                                <td><p><strong>Kode pos 1:</strong> {{ $pelanggan->kodepos1 }}</p></td>
                                <td><p><strong>Kode pos 2:</strong> {{ $pelanggan->kodepos2 }}</p></td>
                                <td><p><strong>Kode pos 3:</strong> {{ $pelanggan->kodepos3 }}</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>

    </ul> </p>

</div>

<li data-aos="fade-up">Foto: <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto Pelanggan" width="200"></li>




<div class="button-container" data-aos="fade-up">
    <form method="POST" action="{{ url('/keluar') }}">
    @csrf
    <button type="submit" class="btn btn-danger keluar">Logout</button>
    </form>
</div>


</section>
