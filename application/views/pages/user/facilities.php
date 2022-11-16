<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?= $css ?>
    <?= $js ?>
    <style>
        .img {
            width: 100%;
            transition: .2s;
        }

        .img:hover {
            transform: scale(1.1);
        }

        .hyperlink {
            text-decoration: none;
            color: #3d66a7;
            transition: .1s linear;
        }

        .hyperlink:hover {
            color: grey;
        }
    </style>
</head>

<body>
    <?= $navbar ?>
    <br>
    <h2 class="text-center bluetext">Facilities Listing</h2>
    <h6 class="text-center">Preview and book facilities from this page</h6><br>
    <div class="container-md" style="margin-bottom: 5%;">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($facility as $f) : ?>
                <div class="col-sm-3">
                    <div class="card h-100 shadow bg-body rounded">
                        <a href="<?= base_url('User/showDetails?id='), $f['facilityId'] ?>" ><img src="<?= base_url('assets/images/'), $f['facilityImg'] ?>" class="card-img-top img"></a>
                        <div class="card-body">
                            <a href="<?= base_url('User/showDetails?id='), $f['facilityId'] ?>" class="text-center hyperlink">
                                <h5><?= str_replace("'", "", $f['facilityName']) ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br>
    <?= $footer ?>
</body>

</html>