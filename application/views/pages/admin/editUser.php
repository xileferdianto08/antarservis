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
        <div class="col-lg-5 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-3">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3 class="text-center bluetext">Edit Users</h3><br>
                        <?php foreach($usersData as $data): ?>
                        <?php echo form_open_multipart("Admin/editUsers/$id", array('class' => 'form-horizontal',)); ?>

                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="name" class="control-label " style="text-align:left; margin-top:2%">User Name:</label><br>
                            <div class="col-lg-12">
                                <?= form_input('name', $data['username'], 'class="form-control"') ?>
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
                                <input type="email" class="form-control" name="email" id="email" value="<?= $data['email'] ?>">
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('email', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="roles" class="control-label" style="text-align:left; margin-top:2%">Roles:</label><br>
                            <div class="col-lg-12">
                                <select name="roles" id="roles" class="form-control">
                                    <option value="" selected>Choose User's Roles</option>
                                    <?php foreach($roles as $role): ?>
                                    <option value="<?= $role['userType'] ?>" <?php if($data['userType'] === $role['userType']) {echo "selected";} ?>><?= $role['userType'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div style="margin-left: 30%;margin-top:2%; margin-bottom:2%">
                                <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                                <a href="<?= base_url('Admin/userList') ?>"><button type="button" class="btn btn-warning">Return to Listing</button></a>
                            </div>
                        </div>

                        <?php echo form_close(); 
                            endforeach;
                        ?>

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
    <?= $footer ?>
</body>

</html>