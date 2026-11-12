<h3 class="mb-3">Ubah Penyewa</h3>

<form action="<?= BASEURL; ?>/penyewa/update" method="post" class="card card-body" style="max-width: 600px">
    <input type="hidden" name="id" value="<?= $data['penyewa']['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?= e($data['penyewa']['nama']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. KTP</label>
        <input type="text" name="no_ktp" class="form-control" value="<?= e($data['penyewa']['no_ktp']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="<?= e($data['penyewa']['no_hp']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" required><?= e($data['penyewa']['alamat']); ?></textarea>
    </div>
    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/penyewa" class="btn btn-secondary">Batal</a>
    </div>
</form>
