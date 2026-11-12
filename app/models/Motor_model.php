<?php
class Motor_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM motor ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function getTersedia()
    {
        $this->db->query("SELECT * FROM motor WHERE status = 'tersedia'");
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM motor WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function tambah($data, $foto)
    {
        $query = "INSERT INTO motor (plat_nomor, merk, tipe, tahun, warna, harga_per_hari, foto)
                  VALUES (:plat, :merk, :tipe, :tahun, :warna, :harga, :foto)";
        $this->db->query($query);
        $this->db->bind(':plat', $data['plat_nomor']);
        $this->db->bind(':merk', $data['merk']);
        $this->db->bind(':tipe', $data['tipe']);
        $this->db->bind(':tahun', $data['tahun']);
        $this->db->bind(':warna', $data['warna']);
        $this->db->bind(':harga', $data['harga_per_hari']);
        $this->db->bind(':foto', $foto);
        return $this->db->execute();
    }

    public function ubah($id, $data, $foto)
    {
        $query = "UPDATE motor SET plat_nomor = :plat, merk = :merk, tipe = :tipe, tahun = :tahun,
                  warna = :warna, harga_per_hari = :harga, foto = :foto WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':plat', $data['plat_nomor']);
        $this->db->bind(':merk', $data['merk']);
        $this->db->bind(':tipe', $data['tipe']);
        $this->db->bind(':tahun', $data['tahun']);
        $this->db->bind(':warna', $data['warna']);
        $this->db->bind(':harga', $data['harga_per_hari']);
        $this->db->bind(':foto', $foto);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function hapus($id)
    {
        $this->db->query('DELETE FROM motor WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
