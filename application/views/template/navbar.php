<?php defined('BASEPATH') OR exit('No direct script access allowed !'); ?>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <?php if($userType === "User"): ?>
    <a class="navbar-brand" href="<?= base_url("User") ?>"> <i class="bi bi-building"></i> AntarServis</a>
    <?php endif; ?>
    <?php if($userType === "Admin"): ?>
    <a class="navbar-brand" href="<?= base_url("Admin") ?>"> <i class="bi bi-toggles"></i> AntarServis</a>
    <?php endif; ?>
    <?php if($userType === "Management"): ?>
    <a class="navbar-brand" href="<?= base_url("Management") ?>"> <i class="bi bi-journal-richtext"></i> AntarServis</a>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#content" aria-controls="content" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="content">
      <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <?php 
          if($userType === "User"){
        ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url("User") ?>">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("User/requestList") ?>">Requests</a>
          </li>  
        <?php 
          } else if($userType === "Admin"){
        ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url("Admin/userList") ?>">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url("Admin") ?>">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("Admin/reqList") ?>">Requests</a>
          </li>
        <?php 
          } else if($userType === "Management"){
        ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url("Management") ?>">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("Management/reqList") ?>">Requests</a>
          </li>
        <?php } ?>
      </ul>        
      <ul class="nav navbar-nav navbar-right"style="padding:0 1% 0 0" >
            <li class="dropdown">
                <a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, <?= $username ?><span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                 <li><a class="dropdown-item" href="<?= base_url("Login/logout") ?>">Sign Out </a></li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>