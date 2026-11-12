<?php
class Rental_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Data rental + nama penyewa + data motor (digabung dengan JOIN)
    public function getAll()
    {
        $query = "SELECT rental.*, motor.merk, motor.tipe, motor.plat_nomor, motor.foto,
                  penyewa.nama AS nama_penyewa
                  FROM rental
                  JOIN motor ON motor.id = rental.motor_id
                  JOIN penyewa ON penyewa.id = rental.penyewa_id
                  ORDER BY rental.id DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $query = "SELECT rental.*, motor.harga_per_hari
                  FROM rental
                  JOIN motor ON motor.id = rental.motor_id
                  WHERE rental.id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Simpan transaksi rental, lalu ubah status motor menjadi 'disewa'
    public function tambah($data, $lama, $total)
    {
        $query = "INSERT INTO rental (motor_id, penyewa_id, tgl_sewa, tgl_kembali_rencana, lama_hari, total_biaya)
                  VALUES (:motor, :penyewa, :sewa, :kembali, :lama, :total)";
        $this->db->query($query);
        $this->db->bind(':motor', $data['motor_id']);
        $this->db->bind(':penyewa', $data['penyewa_id']);
        $this->db->bind(':sewa', $data['tgl_sewa']);
        $this->db->bind(':kembali', $data['tgl_kembali']);
        $this->db->bind(':lama', $lama);
        $this->db->bind(':total', $total);
        $berhasil = $this->db->execute();

        if ($berhasil) {
            $this->db->query("UPDATE motor SET status = 'disewa' WHERE id = :id");
            $this->db->bind(':id', $data['motor_id']);
            $this->db->execute();
        }
        return $berhasil;
    }

    // Motor dikembalikan: rental selesai, status motor kembali 'tersedia'
    public function kembalikan($id, $denda, $tanggal)
    {
        $rental = $this->getById($id);

        $query = "UPDATE rental SET status = 'selesai', tgl_kembali_aktual = :tgl, denda = :denda
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':tgl', $tanggal);
        $this->db->bind(':denda', $denda);
        $this->db->bind(':id', $id);
        $this->db->execute();

        $this->db->query("UPDATE motor SET status = 'tersedia' WHERE id = :id");
        $this->db->bind(':id', $rental['motor_id']);
        $this->db->execute();
    }
}
