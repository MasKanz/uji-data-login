<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Lengkapi Alamat Anda</h2>
    <form action="{{ route('pelanggan.updateAlamat') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Alamat 1 -->
        <div class="mb-4">
            <label>Alamat 1</label>
            <input type="textarea" name="alamat1" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Kota 1</label>
            <input type="textarea" name="kota1" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Provinsi 1</label>
            <input type="textarea" name="propinsi1" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Kode Pos 1</label>
            <input type="textarea" name="kodepos1" class="w-full border rounded p-2" required>
        </div>

        <!-- Alamat 2 -->
        <div class="mb-4">
            <label>Alamat 2</label>
            <input type="textarea" name="alamat2" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Kota 2</label>
            <input type="textarea" name="kota2" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Provinsi 2</label>
            <input type="textarea" name="propinsi2" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Kode Pos 2</label>
            <input type="textarea" name="kodepos2" class="w-full border rounded p-2">
        </div>

        <!-- Alamat 3 -->
        <div class="mb-4">
            <label>Alamat 3</label>
            <input type="textarea" name="alamat3" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Kota 3</label>
            <input type="textarea" name="kota3" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Provinsi 3</label>
            <input type="textarea" name="propinsi3" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label>Kode Pos 3</label>
            <input type="textarea" name="kodepos3" class="w-full border rounded p-2">
        </div>

        <!-- Upload Foto -->
        <div class="mb-4">
            <label>Upload Foto</label>
            <input type="file" name="foto" class="w-full border rounded p-2" accept="image/*">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Simpan Data
        </button>
    </form>
</div>
