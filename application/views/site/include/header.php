<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$this->config->item('PROJECT');?></title>
  <link href="<?= site_url('assets/site/'); ?>css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/line-awesome.min.css">
  <!-- <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/owl.theme.default.min.css"> -->
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/jquery.dataTables.min.css">
  <link href="<?= site_url('assets/site/'); ?>css/font-awesome.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="<?= site_url('assets/site/'); ?>img/favi.png">
  <link href="<?= site_url('assets/site/'); ?>css/style.css?time=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <!-- start -->
  <div class="main_nav">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar line_us1"></span>

            <span class="icon-bar line_us2"></span>

            <span class="icon-bar line_us3"></span>
          </button>
          <a class="navbar-brand logo_m" href="<?= site_url() ?>">
            <img src="<?= site_url('assets/site/'); ?>img/logo.png">
          </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?= site_url() ?>">Home</a>
            </li>
            <li>
              <a href="<?= site_url('About') ?>">About Us</a>
            </li>
            <li>
              <a href="<?= site_url('Newses') ?>">News</a>
            </li>
            <li>
              <a href="<?= site_url('Jobs') ?>">Job Search</a>
            </li>
            <!-- <li>
              <a href="<?= site_url('Work') ?>">Work With Us</a>
            </li> -->
            <li>
              <a href="<?= site_url('Contact') ?>">Contact Us</a>
            </li>
            <?php
            if ($this->session->userdata('is_user_logged_in')) {
            ?>
              <li class="user_dropp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="img_radiuus">
                    <img src="<?= site_url('assets/site/img/'); ?>user_d1.png">
                    User Name
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= site_url('Profile') ?>">Profile</a></li>
                  <li><a href="<?= site_url('Logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
              </li>
            <?php
            } else {
            ?>
              <li><a href="<?= site_url('Login') ?>">Login</a></li>
              <li class="Sign_top sel1"><a href="<?= site_url('Sign-Up') ?>" class="btn btn_theme" style="background: transparent;color: var(--red);border: 1px solid;">Sign Up</a></li>
            <?php
            }
            ?>
            <li class="Sign_top "><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Request a professional</a></li>
            <li class="flangg_d">
              <form id="form1" runat="server">
                <div id="google_translate_element" style="display: none">
                </div>
                <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="flag">
                    <img src="<?= site_url('assets/site/'); ?>img/English.png" id="current-selected-language" >
                  </span>
                </a>
                <ul class="dropdown-menu">
                <li><a href="javascript:;" id="English" onclick="translateLanguage(this.id, 'English.png');">
                      <img src="<?= site_url('assets/site/'); ?>img/English.png" alt="" /></a> </li>
                  <li><a href="javascript:;" id="French" onclick="translateLanguage(this.id, 'French.png');">
                      <img src="<?= site_url('assets/site/'); ?>img/French.png" alt="" /></a> </li>
                  <li><a href="javascript:;" id="Spanish" onclick="translateLanguage(this.id, 'Spanish.png');">
                  
                      <img src="<?= site_url('assets/site/'); ?>img/Spanish.png" alt="" /></a> </li>
                  <li><a href="javascript:;" id="Chinese" onclick="translateLanguage(this.id, 'Chinese.png');">
                  
                      <img src="<?= site_url('assets/site/'); ?>img/Chinese.png" alt="" /></a> </li>
                  <li><a href="javascript:;" id="Arabic" onclick="translateLanguage(this.id, 'Arabic.png');">
                  
                      <img src="<?= site_url('assets/site/'); ?>img/Arabic.png" alt="" /></a> </li>


                  <li><a href="javascript:;" id="Portuguese" onclick="translateLanguage(this.id, 'Portuguese.png');">
                  
                      <img src="<?= site_url('assets/site/'); ?>img/Portuguese.png" alt="" /></a> </li>
                </ul>
              </li>
                
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- close -->