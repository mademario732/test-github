<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Rental</h3>
    <a href="<?= BASEURL; ?>/rental/tambah" class="btn btn-primary">+ Rental Baru</a>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Penyewa</th>
            <th>Motor</th>
            <th>Tgl Sewa</th>
            <th>Rencana Kembali</th>
            <th>Tgl Kembali</th>
            <th>Lama</th>
            <th>Total</th>
            <th>Denda</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data['rental'] as $r) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= e($r['nama_penyewa']); ?></td>
                <td>
                    <img src="<?= BASEURL; ?>/img/<?= e($r['foto']); ?>" class="foto-kecil mb-1" alt="foto"><br>
                    <?= e($r['merk'] . ' ' . $r['tipe']); ?><br>
                    <small class="text-muted"><?= e($r['plat_nomor']); ?></small>
                </td>
                <td><?= date('d-m-Y', strtotime($r['tgl_sewa'])); ?></td>
                <td><?= date('d-m-Y', strtotime($r['tgl_kembali_rencana'])); ?></td>
                <td>
                    <?php if ($r['tgl_kembali_aktual']) : ?>
                        <?= date('d-m-Y', strtotime($r['tgl_kembali_aktual'])); ?>
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= $r['lama_hari']; ?> hari</td>
                <td>Rp <?= number_format($r['total_biaya'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($r['denda'], 0, ',', '.'); ?></td>
                <td>
                    <?php if ($r['status'] == 'selesai') : ?>
                        <span class="badge text-bg-success">Selesai</span>
                    <?php elseif (date('Y-m-d') > $r['tgl_kembali_rencana']) : ?>
                        <span class="badge text-bg-danger">Terlambat</span>
                    <?php else : ?>
                        <span class="badge text-bg-warning">Berjalan</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($r['status'] == 'berjalan') : ?>
                        <form action="<?= BASEURL; ?>/rental/kembali/<?= $r['id']; ?>" method="post"
                              onsubmit="return confirm('Proses pengembalian motor ini?')">
                            <button type="submit" name="kembali" class="btn btn-sm btn-success">Kembalikan</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
