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
</head>

<body>
    <?= $navbar ?>
    <br>
    <?php foreach($facilityDetails as $detail): ?>
        <div class="container">
            <h2 class="text-center bluetext"><?= str_replace("'", "", $detail['facilityName']) ?></h2><br>
            <img style="margin-left: 20%; margin-bottom:2%" src="<?= base_url('assets/images/'),$detail['facilityImg'] ?>" width="55%">
            <p><?= str_replace("'", "", $detail['description']) ?></p>
            <div style="margin-left: 40%;margin-top:2%; margin-bottom:2%">
                <a href="<?= base_url('User/formsBookFacility?id='),$detail['facilityId'] ?>"><button type="button" class="btn btn-primary">Book</button></a>
                <a href="<?= base_url('User') ?>"><button type="button" class="btn btn-warning">Return to Listing</button></a> 
            </div>

        </div>
    <?php endforeach; ?>
    <br>
    <?= $footer ?>
</body>

</html>