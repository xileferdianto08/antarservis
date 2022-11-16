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
        <div class="col-lg-4 mx-auto" >
            <div class="bg-white rounded-lg shadow-lg p-3">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3 class="text-center bluetext">Booking Form</h3><br>
                        <?php echo form_open("User/bookingFacility?id=$id", array('class' => 'form-horizontal', )); ?>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="id" class="control-label" style="text-align:left">Facility ID:</label><br>
                            <div class="col-lg-12">
                                <?php echo form_input('id', $id, 'class="form-control" disabled') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="date" class="control-label " style="text-align:left; margin-top:2%">Reservation Date:</label><br>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" name="date" id="date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="startTime" class="control-label" style="text-align:left; margin-top:2%">Start Time:</label><br>
                            <div class="col-lg-12">
                                <input type="time" class="form-control" name="startTime" id="startTime"  required>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="endTime" class="control-label" style="text-align:left; margin-top:2%">End Time:</label><br>
                            <div class="col-lg-12">
                                <input type="time" class="form-control" name="endTime" id="endTime"  required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div style="margin-left: 25%;margin-top:2%; margin-bottom:2%">
                                <button type="submit" class="btn btn-primary" name="submit">Book</button>
                                <a href="<?= base_url('User') ?>"><button type="button" class="btn btn-warning">Return to Listing</button></a>
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
    <?= $footer ?>
</body>

</html>