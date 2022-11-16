<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?= $js ?>
    <?= $css ?>
</head>

<body>
    <?= $navbar ?>
    <br>


    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-3">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3 class="text-center bluetext">Add New Facilities</h3><br>
                        <?php echo form_open_multipart("Admin/addFacility", array('class' => 'form-horizontal',)); ?>

                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="name" class="control-label " style="text-align:left; margin-top:2%">Facility Name:</label><br>
                            <div class="col-lg-12">
                                <?= form_input('name', '', 'class="form-control"') ?>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('name', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="description" class="control-label" style="text-align:left; margin-top:2%">Description:</label><br>
                            <div class="col-lg-12">
                                <textarea name="description" id="description" cols="97" rows="10"></textarea>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('description', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="image" class="control-label" style="text-align:left">Facility Image:</label><br>
                            <div class="col-lg-11">
                                <?php echo form_upload('image', '', 'class="form-control"') ?>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <p style="color:red;margin:0;padding:0;"><?php echo $error; ?></p>
                            </div>

                        </div>
                        <br>
                        <div class="form-group">
                            <div style="margin-left: 40%;margin-top:2%; margin-bottom:2%">
                                <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                                <a href="<?= base_url('Admin') ?>"><button type="button" class="btn btn-warning">Return to Listing</button></a>
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?= $footer ?>
</body>

</html>