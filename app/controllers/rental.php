<?php
class Rental extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Rental';
        $data['rental'] = $this->model('Rental_model')->getAll();

        $this->view('templates/header', $data);
        $this->view('rental/index', $data);
        $this->view('templates/footer', $data);
    }
    public function tambah($motor_id = 0)
    {
        if (isset($_POST['simpan'])) {
            $motor = $this->model('Motor_model')->getById($_POST['motor_id']);
            $tglSewa = strtotime($_POST['tgl_sewa']);
            $tglKembali = strtotime($_POST['tgl_kembali']);

            if (!$motor || $motor['status'] != 'tersedia') {
                Flasher::setFlash('Motor tidak tersedia.', 'danger');
            } elseif ($tglKembali < $tglSewa) {
                Flasher::setFlash('Tanggal kembali tidak boleh sebelum tanggal sewa.', 'danger');
            } else {

                $lama = round(($tglKembali - $tglSewa) / 86400);
                if ($lama < 1) {
                    $lama = 1;
                }
                $total = $lama * $motor['harga_per_hari'];

                if ($this->model('Rental_model')->tambah($_POST, $lama, $total)) {
                    Flasher::setFlash('Rental berhasil dicatat.', 'success');
                } else {
                    Flasher::setFlash('Rental gagal dicatat.', 'danger');
                }
            }
            header('Location: ' . BASEURL . '/rental');
            exit;
        }

        $data['judul'] = 'Rental Baru';
        $data['motor_id'] = $motor_id;
        $data['motor'] = $this->model('Motor_model')->getTersedia();
        $data['penyewa'] = $this->model('Penyewa_model')->getAll();

        $this->view('templates/header', $data);
        $this->view('rental/tambah', $data);
        $this->view('templates/footer', $data);
    }

    // Proses pengembalian motor + hitung denda
    public function kembali($id = 0)
    {
        if (isset($_POST['kembali'])) {
            $model = $this->model('Rental_model');
            $rental = $model->getById($id);

            if ($rental && $rental['status'] == 'berjalan') {
                $hariIni = strtotime(date('Y-m-d'));
                $rencana = strtotime($rental['tgl_kembali_rencana']);

                // hitung berapa hari terlambat
                $telat = 0;
                if ($hariIni > $rencana) {
                    $telat = round(($hariIni - $rencana) / 86400);
                }
                $denda = $telat * $rental['harga_per_hari'] * DENDA_PERSEN / 100;

                $model->kembalikan($id, $denda, date('Y-m-d'));

                if ($denda > 0) {
                    Flasher::setFlash('Motor dikembalikan terlambat ' . $telat . ' hari. Denda: Rp ' . number_format($denda, 0, ',', '.'), 'warning');
                } else {
                    Flasher::setFlash('Motor berhasil dikembalikan tepat waktu.', 'success');
                }
            } else {
                Flasher::setFlash('Data rental tidak ditemukan atau sudah selesai.', 'danger');
            }
        }
        header('Location: ' . BASEURL . '/rental');
        exit;
    }
}
