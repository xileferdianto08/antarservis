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
            <div class="bg-white rounded-lg shadow-lg p-10">
                <h4 class="bluetext" style="padding-top:2%;margin-left:2%;margin-top:2%">Facilities List</h4>
                <a href="<?= base_url('Management/formAddFacility') ?>" style="float:right;margin-bottom:2%;margin-right:15px;margin-top:-4%">
                    <button class="btn btn-sm btn-secondary">Add</button>
                </a>
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <table class="table table-hover" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                foreach($facilityList as $data): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td style="width: 50%;"><img src="<?= base_url('assets/images/').$data['facilityImg'] ?>" alt="No Photo Used" width="50%" style="margin-left: 20%;" ></td>
                                    <td><?= str_replace("'", "", $data['facilityName'])  ?></td>
                                    <td style="width: 15%;">
                                        <a href="<?= base_url('Management/formEditFacility/'),$data['facilityId'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('Management/deleteFacility/'),$data['facilityId']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this facility?')">Delete</a>
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
    <?= $footer ?>
</body>

</html>