<?php
class Penyewa extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Penyewa';
        $data['penyewa'] = $this->model('Penyewa_model')->getAll();

        $this->view('templates/header', $data);
        $this->view('penyewa/index', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        if (isset($_POST['simpan'])) {
            if (empty($_POST['nama']) || empty($_POST['no_ktp']) || empty($_POST['no_hp'])) {
                Flasher::setFlash('Data belum lengkap.', 'danger');
            } elseif ($this->model('Penyewa_model')->tambah($_POST)) {
                Flasher::setFlash('Penyewa berhasil ditambahkan.', 'success');
            } else {
                Flasher::setFlash('Penyewa gagal ditambahkan. No. KTP mungkin sudah terdaftar.', 'danger');
            }
            header('Location: ' . BASEURL . '/penyewa');
            exit;
        }

        $data['judul'] = 'Tambah Penyewa';
        $data['action'] = BASEURL . '/penyewa/tambah';
        $data['penyewa'] = ['nama' => '', 'no_ktp' => '', 'no_hp' => '', 'alamat' => ''];

        $this->view('templates/header', $data);
        $this->view('penyewa/form', $data);
        $this->view('templates/footer', $data);
    }

    public function ubah($id = 0)
    {
        $model = $this->model('Penyewa_model');
        $penyewa = $model->getById($id);

        if (!$penyewa) {
            Flasher::setFlash('Penyewa tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/penyewa');
            exit;
        }

        if (isset($_POST['simpan'])) {
            if (empty($_POST['nama']) || empty($_POST['no_ktp']) || empty($_POST['no_hp'])) {
                Flasher::setFlash('Data belum lengkap.', 'danger');
            } elseif ($model->ubah($id, $_POST)) {
                Flasher::setFlash('Data penyewa berhasil diubah.', 'success');
            } else {
                Flasher::setFlash('Data penyewa gagal diubah. No. KTP mungkin sudah dipakai.', 'danger');
            }
            header('Location: ' . BASEURL . '/penyewa');
            exit;
        }

        $data['judul'] = 'Ubah Penyewa';
        $data['action'] = BASEURL . '/penyewa/ubah/' . $id;
        $data['penyewa'] = $penyewa;

        $this->view('templates/header', $data);
        $this->view('penyewa/form', $data);
        $this->view('templates/footer', $data);
    }

    public function hapus($id = 0)
    {
        if (isset($_POST['hapus'])) {
            if ($this->model('Penyewa_model')->hapus($id)) {
                Flasher::setFlash('Penyewa berhasil dihapus.', 'success');
            } else {
                Flasher::setFlash('Penyewa tidak bisa dihapus (sudah punya riwayat rental).', 'danger');
            }
        }
        header('Location: ' . BASEURL . '/penyewa');
        exit;
    }
}
