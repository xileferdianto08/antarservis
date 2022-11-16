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
        body {
            background-image: url('http://localhost/antarservis/assets/background/home.png');
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-4">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h4 class="bluetext text-center" style="padding-top:2%;margin-left:2%;">Register</h4>
                        <?php echo $this->session->flashdata('msg'); ?>
                        <?= form_open("Register/doRegister", array('class' => 'form-horizontal',)); ?>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="name" class="control-label" style="text-align:left; margin-top:2%">User Name:</label><br>
                            <div class="col-lg-12">
                                <?= form_input('name', '', 'class="form-control" required') ?>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('name', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="email" class="control-label" style="text-align:left; margin-top:2%">Email:</label><br>
                            <div class="col-lg-12">
                                <?= form_input('email', '', 'class="form-control" required') ?>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('email', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="password" class="control-label" style="text-align:left; margin-top:2%">Password:</label><br>
                            <div class="col-lg-12">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('password', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="" class="control-label" style="text-align:left; margin-top:2%">Masukkan Kode Captcha Berikut:</label><br>
                            <div class="col-lg-12">
                                <img src="<?= base_url('Register/captcha') ?>" width="100" height="45" alt="Kode Acak" />
                                <br>
                                <input class="form-control" type="text" name="kode" id="kodeval" size="6" maxlength="6" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="margin-left: 40%;margin-top:5%; margin-bottom:1%">
                            <button type="submit" class="btn btn-primary" name="submit">Register</button>
                            <a href="<?= base_url('Welcome') ?>"><button type="button" class="btn btn-warning">Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>