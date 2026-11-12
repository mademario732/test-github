<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Motor</h3>
    <a href="<?= BASEURL; ?>/motor/tambah" class="btn btn-primary">+ Tambah Motor</a>
</div>

<table class="table table-bordered table-striped bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Plat</th>
            <th>Motor</th>
            <th>Tahun</th>
            <th>Warna</th>
            <th>Harga / Hari</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data['motor'] as $m) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><img src="<?= BASEURL; ?>/img/<?= e($m['foto']); ?>" class="foto-kecil" alt="foto"></td>
                <td><?= e($m['plat_nomor']); ?></td>
                <td><?= e($m['merk'] . ' ' . $m['tipe']); ?></td>
                <td><?= e($m['tahun']); ?></td>
                <td><?= e($m['warna']); ?></td>
                <td>Rp <?= number_format($m['harga_per_hari'], 0, ',', '.'); ?></td>
                <td>
                    <?php if ($m['status'] == 'tersedia') : ?>
                        <span class="badge text-bg-success">Tersedia</span>
                    <?php else : ?>
                        <span class="badge text-bg-warning">Disewa</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= BASEURL; ?>/motor/ubah/<?= $m['id']; ?>" class="btn btn-sm btn-outline-primary">Ubah</a>
                    <form action="<?= BASEURL; ?>/motor/hapus/<?= $m['id']; ?>" method="post" class="d-inline"
                          onsubmit="return confirm('Yakin hapus motor ini?')">
                        <button type="submit" name="hapus" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
