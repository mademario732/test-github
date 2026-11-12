<?php
class Penyewa_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM penyewa ORDER BY nama');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM penyewa WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function tambah($data)
    {
        $query = "INSERT INTO penyewa (nama, no_ktp, no_hp, alamat) VALUES (:nama, :ktp, :hp, :alamat)";
        $this->db->query($query);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':ktp', $data['no_ktp']);
        $this->db->bind(':hp', $data['no_hp']);
        $this->db->bind(':alamat', $data['alamat']);
        return $this->db->execute();
    }

    public function ubah($id, $data)
    {
        $query = "UPDATE penyewa SET nama = :nama, no_ktp = :ktp, no_hp = :hp, alamat = :alamat WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':ktp', $data['no_ktp']);
        $this->db->bind(':hp', $data['no_hp']);
        $this->db->bind(':alamat', $data['alamat']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function hapus($id)
    {
        $this->db->query('DELETE FROM penyewa WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
