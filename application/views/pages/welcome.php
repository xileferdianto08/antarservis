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

    <div class="title" style="margin-top: 10%;">
        <div class="title-inner">
            <div class="cafe">
                <div class="cafe-inner">
                    <h1 class="text-center color-text">Welcome to AntarServis</h1>
                    <h4 class="text-center color-text">
                        Where we can give a facility you need
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="button">
        <a class="btn btn-secondary" style="margin-right:10px;" href="<?= base_url('Login') ?>">Login</a>
        <a class="btn btn-warning" href="<?= base_url('Register') ?>">Register Now</a>
    </div>


</body>

</html>