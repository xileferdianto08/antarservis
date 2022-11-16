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
        <div class="col-lg-9 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-7">
                <h4 class="bluetext" style="padding-top:2%;margin-left:2%;margin-top:2%">Request Listing</h4>
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <table class="table table-hover" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Requester</th>
                                    <th class="text-center">Requested Facility</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Start Time</th>
                                    <th class="text-center">End Time</th>
                                    <th class="text-center">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                foreach($bookList as $data): 
                                    $phpdate1 = strtotime($data['reserveDate']);
                                    $reserveDate = date('Y/m/d', $phpdate1);
                                    
                                    $phpdate2 = strtotime($data['startTime']);
                                    $startTime = date('H:i', $phpdate2);

                                    $phpdate3 = strtotime($data['endTime']);
                                    $endTime = date('H:i', $phpdate3);
                                ?>
                                <tr>
                                    <td style="width: 7%;"><?= $i ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td style="width: 20%;"><?= str_replace("'", "", $data['facility_name']) ?></td>
                                    <td style="width: 15%;"><?= $reserveDate ?></td>
                                    <td style="width: 8%;"><?= $startTime ?></td>
                                    <td style="width: 8%;"><?= $endTime ?></td>
                                    <td style="width: 18%;">
                                        <a href="<?= base_url('Management/updatingPermission/').$data['bookingId']."/Approved" ?>" class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to update the permission?')">Approved</a>
                                        <a href="<?= base_url('Management/updatingPermission/').$data['bookingId']."/Rejected" ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to update the permission?')">Rejected</a>
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
    <?= $footer ?>
</body>

</html>