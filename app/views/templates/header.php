<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($data['judul']); ?> - Rental Motor</title>
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASEURL; ?>">
            <img src="<?= BASEURL; ?>/img/logo.svg" width="30" height="30" class="me-2" alt="logo">Rental Motor
        </a>
        <div class="navbar-nav flex-row">
            <a class="nav-link me-3" href="<?= BASEURL; ?>/home">Dashboard</a>
            <a class="nav-link me-3" href="<?= BASEURL; ?>/motor">Motor</a>
            <a class="nav-link me-3" href="<?= BASEURL; ?>/penyewa">Penyewa</a>
            <a class="nav-link" href="<?= BASEURL; ?>/rental">Rental</a>
        </div>
    </div>
</nav>

<div class="container py-4">
<?php Flasher::flash(); ?>
