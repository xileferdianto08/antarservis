<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?= $js ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/animation.css') ?>">
    <?= $css ?>
    <style>
        body {
            background-image: url('http://localhost/antarservis/assets/background/home.png');
            width: 100%;
            height: 100%;
        }

        .color-text {
            color: black;
        }
    </style>
</head>
<body>
    <h1 class="text-center color-text" style="margin-top:7%">The Page You're Looking Is Either Not Found Or Inaccessible</h1>
    <h1 class="text-center color-text" style="margin-top:-9%;">Halaman Yang Anda Cari Tidak Tersedia ataupun Tidak Dapat Diakses</h1>
</body>
</html>