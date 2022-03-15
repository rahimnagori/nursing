<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pambron</title>
  <link href="<?=site_url('assets/admin/');?>css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=site_url('assets/admin/');?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?=site_url('assets/admin/');?>css/line-awesome.min.css">
  <link rel="stylesheet" href="<?=site_url('assets/admin/');?>css/jquery.dataTables.min.css">
  <link href="<?=site_url('assets/admin/');?>css/font-awesome.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="<?=site_url('assets/site/');?>img/favicon.ico">
  <link href="<?=site_url('assets/admin/');?>css/style.css?time=<?=time();?>" rel="stylesheet">
</head>
<body>
  <div class="header_top">
    <div class="header_top2">
      <div class="logo">
        <a href="<?=site_url('Dashboard');?>">
        <img src="<?=site_url('assets/site/');?>img/logo.png">
        </a>
      </div>
      <div class="napingation">
        <span class="butobn_menu">
        <button class="btn btn_theme2 toggle_us" >
        <i class="fa fa-bars"></i>
        </button>
        </span>
        <ul class="ul_set">
          <li class="user_dropp">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="img_radiuus">
            <img src="<?=site_url('assets/admin/');?>img/img_1.png">
            <span class="namee"><?=$adminData['first_name'] .' ' .$adminData['last_name'];?></span>
            </span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?=site_url('Admin-Profile');?>"><i class="la la-user"></i>Profile</a></li>
              <li><a href="<?=site_url('Admin/Logout');?>"><i class="la la-sign-out"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>

<?php include_once 'sidebar.php'; ?>