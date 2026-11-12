<?php
class Flasher
{
    // Simpan pesan ke session
    public static function setFlash($pesan, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    // Tampilkan pesan (sekali saja) lalu hapus dari session
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . '">'
                . e($_SESSION['flash']['pesan']) .
                '</div>';
            unset($_SESSION['flash']);
        }
    }
}
