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
                        <h3 class="text-center bluetext">Edit a Facilities</h3><br>
                        <?php
                        foreach ($facilityData as $data) {
                            echo form_open_multipart("Admin/editFacility/$id", array('class' => 'form-horizontal',)); ?>

                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="name" class="control-label " style="text-align:left; margin-top:2%">Facility Name:</label><br>
                                <div class="col-lg-12">
                                    <?= form_input('name', str_replace("'", "",$data['facilityName']), 'class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="description" class="control-label" style="text-align:left; margin-top:2%">Description:</label><br>
                                <div class="col-lg-12">
                                    <textarea name="description" id="description" cols="97" rows="10"><?= str_replace("'", "",$data['description']) ?>
                                    </textarea>
                                </div><br>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="image" class="control-label" style="text-align:left">Facility Image:</label><br>
                                <div class="col-lg-12">
                                    <label for="image" class="btn btn-primary">
                                        <img id="output_image" src="<?php echo base_url('assets/images/'), $data['facilityImg'] ?>" alt="No Photo Used/Available" width="100%" > <i class="bi bi-pencil-square"></i>
                                    </label>
                                    <input id="image" name="image" type="file" onchange="preview_image(event)" />
                                    <?php echo form_hidden('old_image', $data['facilityImg']); ?>
                                </div>

                            </div>
                            <br>
                            <div class="form-group">
                                <div style="margin-left: 40%;margin-top:2%; margin-bottom:2%">
                                    <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                                    <a href="<?= base_url('Admin') ?>"><button type="button" class="btn btn-warning">Return to Listing</button></a>
                                </div>
                            </div>

                        <?php echo form_close();
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
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