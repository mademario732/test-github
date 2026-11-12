<?php $m = $data['motor']; ?>

<h3 class="mb-3"><?= e($data['judul']); ?></h3>

<!-- enctype wajib ada supaya form bisa mengirim file -->
<form action="<?= $data['action']; ?>" method="post" enctype="multipart/form-data" class="card card-body" style="max-width: 640px;">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control" required value="<?= e($m['plat_nomor']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Merk</label>
            <input type="text" name="merk" class="form-control" required value="<?= e($m['merk']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tipe</label>
            <input type="text" name="tipe" class="form-control" required value="<?= e($m['tipe']); ?>">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" required value="<?= e($m['tahun']); ?>">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" required value="<?= e($m['warna']); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Harga per Hari (Rp)</label>
            <input type="number" name="harga_per_hari" class="form-control" required value="<?= e($m['harga_per_hari']); ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Motor (JPG/PNG, maks. 2 MB)</label>
        <div class="mb-2">
            <img src="<?= BASEURL; ?>/img/<?= e($m['foto']); ?>" class="foto-form" alt="foto saat ini">
        </div>
        <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
    </div>

    <div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL; ?>/motor" class="btn btn-link">Batal</a>
    </div>
</form>
