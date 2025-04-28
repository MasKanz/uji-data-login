<section>

<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
      <div class="service-item position-relative">
        <i class="bi bi-bounding-box-circles"></i>
        <h4><a href="" class="stretched-link">Profile</a></h4>
        <p> <ul>
            <li><p>Nama: {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p></li>
            <li><p>Email: {{ Auth::guard('pelanggan')->user()->email }}</p></li>
            <li><p>No. Telp: {{ Auth::guard('pelanggan')->user()->no_telp }}</p></li>
        </ul> </p>
    </div>
</div>




<div class="button-container" data-aos="fade-up">
    <form method="POST" action="{{ url('/keluar') }}">
    @csrf
    <button type="submit" class="keluar">Logout</button>
    </form>
</div>


</section>
