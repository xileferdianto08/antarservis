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
    <h3 class="text-center bluetext">Request List</h3><br>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-7">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <table class="table table-hover" cellspacing="0" style="width: 100%;">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Requested Facility</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Start Time</th>
                                    <th class="text-center">End Time</th>
                                    <th class="text-center">Approved?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($requested as $data):?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $data['facility_name'] ?></td>
                                        <td><?= $data['reserveDate'] ?></td>
                                        <td><?= $data['startTime'] ?></td>
                                        <td><?= $data['endTime'] ?></td>
                                        <td><?= $data['status'] ?></td>
                                    </tr>
                                <?php
                                    $i = $i + 1;
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
    <?= $footer ?>
</body>
</html>