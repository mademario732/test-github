<?php
// Sesuaikan dengan nama folder project di htdocs
define('BASEURL', 'http://localhost/rental_motor/public');

// Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rental_motor');

// Denda keterlambatan per hari = 50% dari harga sewa per hari
define('DENDA_PERSEN', 50);

// Lokasi folder penyimpanan foto motor
define('FOLDER_FOTO', dirname(__DIR__, 2) . '/public/img/');
