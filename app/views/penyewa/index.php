<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Penyewa</h3>
    <a href="<?= BASEURL; ?>/penyewa/tambah" class="btn btn-primary">+ Tambah Penyewa</a>
</div>

<table class="table table-bordered table-striped bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No. KTP</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data['penyewa'] as $p) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= e($p['nama']); ?></td>
                <td><?= e($p['no_ktp']); ?></td>
                <td><?= e($p['no_hp']); ?></td>
                <td><?= e($p['alamat']); ?></td>
                <td>
                    <a href="<?= BASEURL; ?>/penyewa/ubah/<?= $p['id']; ?>" class="btn btn-sm btn-outline-primary">Ubah</a>
                    <form action="<?= BASEURL; ?>/penyewa/hapus/<?= $p['id']; ?>" method="post" class="d-inline"
                          onsubmit="return confirm('Yakin hapus penyewa ini?')">
                        <button type="submit" name="hapus" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
