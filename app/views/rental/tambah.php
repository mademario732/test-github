<h3 class="mb-3">Rental Baru</h3>

<form action="<?= BASEURL; ?>/rental/tambah" method="post" class="card card-body" style="max-width: 640px;">
    <div class="mb-3">
        <label class="form-label">Penyewa</label>
        <select name="penyewa_id" class="form-select" required>
            <option value="">-- pilih penyewa --</option>
            <?php foreach ($data['penyewa'] as $p) : ?>
                <option value="<?= $p['id']; ?>"><?= e($p['nama']); ?> (<?= e($p['no_ktp']); ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Motor (yang tersedia)</label>
        <select name="motor_id" id="motor_id" class="form-select" required onchange="hitung()">
            <option value="">-- pilih motor --</option>
            <?php foreach ($data['motor'] as $m) : ?>
                <option value="<?= $m['id']; ?>" data-harga="<?= $m['harga_per_hari']; ?>"
                    <?= ($m['id'] == $data['motor_id']) ? 'selected' : ''; ?>>
                    <?= e($m['merk'] . ' ' . $m['tipe'] . ' - ' . $m['plat_nomor']); ?>
                    (Rp <?= number_format($m['harga_per_hari'], 0, ',', '.'); ?>/hari)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Sewa</label>
            <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" required
                   value="<?= date('Y-m-d'); ?>" onchange="hitung()">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required
                   value="<?= date('Y-m-d', strtotime('+1 day')); ?>" onchange="hitung()">
        </div>
    </div>

    <div class="alert alert-info">Perkiraan biaya: <b id="estimasi">-</b></div>

    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan Rental</button>
        <a href="<?= BASEURL; ?>/rental" class="btn btn-link">Batal</a>
    </div>
</form>

<script>
// Perkiraan biaya saja. Perhitungan resmi tetap dilakukan di server (controller rental).
function hitung() {
    var pilih = document.getElementById('motor_id');
    var harga = pilih.options[pilih.selectedIndex].getAttribute('data-harga');
    var sewa = new Date(document.getElementById('tgl_sewa').value);
    var kembali = new Date(document.getElementById('tgl_kembali').value);
    var hari = (kembali - sewa) / (1000 * 60 * 60 * 24);

    if (harga && hari >= 0) {
        if (hari < 1) { hari = 1; }
        var total = hari * harga;
        document.getElementById('estimasi').innerHTML =
            'Rp ' + total.toLocaleString('id-ID') + ' (' + hari + ' hari)';
    } else {
        document.getElementById('estimasi').innerHTML = '-';
    }
}
hitung();
</script>
