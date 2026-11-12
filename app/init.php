<?php
require_once 'core/Constant.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Flasher.php';

// Zona waktu WITA (penting untuk menghitung tanggal & denda)
date_default_timezone_set('Asia/Makassar');

// Fungsi bantu: mengamankan teks sebelum ditampilkan di HTML (mencegah XSS)
function e($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}
