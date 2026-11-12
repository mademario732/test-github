<?php $p = $data['penyewa']; ?>

<h3 class="mb-3"><?= e($data['judul']); ?></h3>

<form action="<?= $data['action']; ?>" method="post" class="card card-body" style="max-width: 640px;">
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required value="<?= e($p['nama']); ?>">
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">No. KTP</label>
            <input type="text" name="no_ktp" class="form-control" required value="<?= e($p['no_ktp']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" required value="<?= e($p['no_hp']); ?>">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" required><?= e($p['alamat']); ?></textarea>
    </div>
    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/penyewa" class="btn btn-link">Batal</a>
    </div>
</form>
