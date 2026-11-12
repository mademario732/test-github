<h3 class="mb-3">Tambah Motor</h3>

<form action="<?= BASEURL; ?>/motor/simpan" method="post" class="card card-body" style="max-width: 600px">
    <div class="mb-3">
        <label class="form-label">Plat Nomor</label>
        <input type="text" name="plat_nomor" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Merk</label>
        <input type="text" name="merk" class="form-control" placeholder="Contoh: Honda" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipe</label>
        <input type="text" name="tipe" class="form-control" placeholder="Contoh: Vario 160" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" value="<?= date('Y'); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Warna</label>
        <input type="text" name="warna" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga per Hari (Rp)</label>
        <input type="number" name="harga_per_hari" class="form-control" min="1" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="tersedia">Tersedia</option>
            <option value="servis">Servis</option>
        </select>
    </div>
    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/motor" class="btn btn-secondary">Batal</a>
    </div>
</form>
