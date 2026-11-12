<?php
class Motor extends Controller
{
    // Menampilkan semua motor
    public function index()
    {
        $data['judul'] = 'Data Motor';
        $data['motor'] = $this->model('Motor_model')->getAll();

        $this->view('templates/header', $data);
        $this->view('motor/index', $data);
        $this->view('templates/footer', $data);
    }

    // Form tambah (GET) dan proses simpan (POST)
    public function tambah()
    {
        if (isset($_POST['simpan'])) {
            if (empty($_POST['plat_nomor']) || empty($_POST['merk']) || empty($_POST['harga_per_hari'])) {
                Flasher::setFlash('Data belum lengkap.', 'danger');
            } else {
                $foto = $this->uploadFoto('default.svg');

                if ($foto == false) {
                    Flasher::setFlash('Upload foto gagal. Gunakan JPG/PNG, maksimal 2 MB.', 'danger');
                } elseif ($this->model('Motor_model')->tambah($_POST, $foto)) {
                    Flasher::setFlash('Motor berhasil ditambahkan.', 'success');
                } else {
                    $this->hapusFoto($foto);
                    Flasher::setFlash('Motor gagal ditambahkan. Plat nomor mungkin sudah terdaftar.', 'danger');
                }
            }
            header('Location: ' . BASEURL . '/motor');
            exit;
        }

        $data['judul'] = 'Tambah Motor';
        $data['action'] = BASEURL . '/motor/tambah';
        $data['motor'] = [
            'plat_nomor' => '', 'merk' => '', 'tipe' => '', 'tahun' => date('Y'),
            'warna' => '', 'harga_per_hari' => '', 'foto' => 'default.svg'
        ];

        $this->view('templates/header', $data);
        $this->view('motor/form', $data);
        $this->view('templates/footer', $data);
    }

    // Form ubah (GET) dan proses update (POST)
    public function ubah($id = 0)
    {
        $model = $this->model('Motor_model');
        $motor = $model->getById($id);

        if (!$motor) {
            Flasher::setFlash('Motor tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/motor');
            exit;
        }

        if (isset($_POST['simpan'])) {
            if (empty($_POST['plat_nomor']) || empty($_POST['merk']) || empty($_POST['harga_per_hari'])) {
                Flasher::setFlash('Data belum lengkap.', 'danger');
            } else {
                // kalau tidak pilih file baru, foto lama dipakai terus
                $foto = $this->uploadFoto($motor['foto']);

                if ($foto == false) {
                    Flasher::setFlash('Upload foto gagal. Gunakan JPG/PNG, maksimal 2 MB.', 'danger');
                } elseif ($model->ubah($id, $_POST, $foto)) {
                    if ($foto != $motor['foto']) {
                        $this->hapusFoto($motor['foto']);
                    }
                    Flasher::setFlash('Data motor berhasil diubah.', 'success');
                } else {
                    if ($foto != $motor['foto']) {
                        $this->hapusFoto($foto);
                    }
                    Flasher::setFlash('Data motor gagal diubah. Plat nomor mungkin sudah dipakai.', 'danger');
                }
            }
            header('Location: ' . BASEURL . '/motor');
            exit;
        }

        $data['judul'] = 'Ubah Motor';
        $data['action'] = BASEURL . '/motor/ubah/' . $id;
        $data['motor'] = $motor;

        $this->view('templates/header', $data);
        $this->view('motor/form', $data);
        $this->view('templates/footer', $data);
    }

    // Hapus motor (hanya lewat tombol hapus / POST)
    public function hapus($id = 0)
    {
        if (isset($_POST['hapus'])) {
            $model = $this->model('Motor_model');
            $motor = $model->getById($id);

            if ($motor && $model->hapus($id)) {
                $this->hapusFoto($motor['foto']);
                Flasher::setFlash('Motor berhasil dihapus.', 'success');
            } else {
                Flasher::setFlash('Motor tidak bisa dihapus (sudah punya riwayat rental).', 'danger');
            }
        }
        header('Location: ' . BASEURL . '/motor');
        exit;
    }

    // Upload foto. Mengembalikan nama file, atau false kalau gagal.
    private function uploadFoto($fotoLama)
    {
        // error 4 = tidak ada file yang dipilih -> pakai foto lama
        if ($_FILES['foto']['error'] == 4) {
            return $fotoLama;
        }
        if ($_FILES['foto']['error'] != 0) {
            return false;
        }

        $namaFile = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $tmp = $_FILES['foto']['tmp_name'];

        // 1. cek ekstensi
        $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
            return false;
        }

        // 2. cek benar-benar gambar
        if (getimagesize($tmp) == false) {
            return false;
        }

        // 3. cek ukuran (maksimal 2 MB)
        if ($ukuran > 2000000) {
            return false;
        }

        // 4. nama baru agar tidak bentrok: motor_xxxx.jpg
        $namaBaru = 'motor_' . uniqid() . '.' . $ekstensi;
        move_uploaded_file($tmp, FOLDER_FOTO . $namaBaru);

        return $namaBaru;
    }

    // Hapus file foto, tapi hanya foto hasil upload (awalan "motor_")
    private function hapusFoto($namaFile)
    {
        if (strpos($namaFile, 'motor_') === 0 && file_exists(FOLDER_FOTO . $namaFile)) {
            unlink(FOLDER_FOTO . $namaFile);
        }
    }
}
