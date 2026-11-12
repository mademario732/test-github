<h3 class="mb-4">Dashboard</h3>

<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div>Total Motor</div>
                <div class="display-6"><?= $data['total']; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card text-bg-success">
            <div class="card-body">
                <div>Motor Tersedia</div>
                <div class="display-6"><?= $data['tersedia']; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card text-bg-warning">
            <div class="card-body">
                <div>Sedang Disewa</div>
                <div class="display-6"><?= $data['disewa']; ?></div>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3">Motor yang Bisa Disewa</h5>
<div class="row">
    <?php if (count($data['motor_tersedia']) == 0) : ?>
        <p class="text-muted">Tidak ada motor yang tersedia.</p>
    <?php endif; ?>

    <?php foreach ($data['motor_tersedia'] as $m) : ?>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="<?= BASEURL; ?>/img/<?= e($m['foto']); ?>" class="card-img-top foto-kartu" alt="foto motor">
                <div class="card-body">
                    <h5 class="card-title"><?= e($m['merk'] . ' ' . $m['tipe']); ?></h5>
                    <p class="card-text mb-1"><?= e($m['plat_nomor']); ?> &middot; <?= e($m['warna']); ?></p>
                    <p class="fw-bold">Rp <?= number_format($m['harga_per_hari'], 0, ',', '.'); ?> / hari</p>
                    <a href="<?= BASEURL; ?>/rental/tambah/<?= $m['id']; ?>" class="btn btn-primary">Sewa</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
