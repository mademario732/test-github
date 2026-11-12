<h3 class="mb-3">Ubah Motor</h3>

<form action="<?= BASEURL; ?>/motor/update" method="post" class="card card-body" style="max-width: 600px">
    <input type="hidden" name="id" value="<?= $data['motor']['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Plat Nomor</label>
        <input type="text" name="plat_nomor" class="form-control" value="<?= e($data['motor']['plat_nomor']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Merk</label>
        <input type="text" name="merk" class="form-control" value="<?= e($data['motor']['merk']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipe</label>
        <input type="text" name="tipe" class="form-control" value="<?= e($data['motor']['tipe']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" value="<?= $data['motor']['tahun']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Warna</label>
        <input type="text" name="warna" class="form-control" value="<?= e($data['motor']['warna']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga per Hari (Rp)</label>
        <input type="number" name="harga_per_hari" class="form-control" min="1" value="<?= $data['motor']['harga_per_hari']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <?php if ($data['motor']['status'] == 'disewa') : ?>
            <!-- Motor yang sedang disewa tidak boleh diubah statusnya secara manual -->
            <input type="text" class="form-control" value="Sedang disewa" disabled>
            <input type="hidden" name="status" value="disewa">
        <?php else : ?>
            <select name="status" class="form-select">
                <option value="tersedia" <?php if ($data['motor']['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
                <option value="servis" <?php if ($data['motor']['status'] == 'servis') echo 'selected'; ?>>Servis</option>
            </select>
        <?php endif; ?>
    </div>
    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/motor" class="btn btn-secondary">Batal</a>
    </div>
</form>
