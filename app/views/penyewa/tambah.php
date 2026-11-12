<h3 class="mb-3">Tambah Penyewa</h3>

<form action="<?= BASEURL; ?>/penyewa/simpan" method="post" class="card card-body" style="max-width: 600px">
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. KTP</label>
        <input type="text" name="no_ktp" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" required></textarea>
    </div>
    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/penyewa" class="btn btn-secondary">Batal</a>
    </div>
</form>
