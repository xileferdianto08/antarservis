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
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-7">
                <h4 class="bluetext" style="padding-top:2%;margin-left:2%;margin-top:2%">Users Listing</h4>
                <a href="<?= base_url('Admin/formAddUsers') ?>" style="float:right;margin-bottom:2%;margin-right:15px;margin-top:-3%">
                    <button class="btn btn-sm btn-secondary">Add</button>
                </a>
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <table class="table table-hover" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                foreach($users as $data): ?>
                                <tr>
                                    <td style="width: 7%;"><?= $i ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td style="width: 20%;"><?= $data['email'] ?></td>
                                    <td style="width: 10%;"><?= $data['userType'] ?></td>
                                    <td style="width: 15%;">
                                        <a href="<?= base_url('Admin/formEditUsers/'), $data['userId'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('Admin/deleteUser/'), $data['userId'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
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
    <br>
    <br>
    <br>
    <br>
    <?= $footer ?>
</body>

</html>