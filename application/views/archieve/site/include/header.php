<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$businessData['business_name'];?></title>

    <link href="<?=site_url('assets/site/css/');?>bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=site_url('assets/site/css/');?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?=site_url('assets/site/css/');?>owl.theme.default.min.css">
    <link href="<?=site_url('assets/site/css/');?>font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="<?=site_url('assets/site/img/');?>favicon.ico">
    <link href="<?=site_url('assets/site/css/');?>jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?=site_url('assets/site/css/');?>animate.css" rel="stylesheet">
    <link href="<?=site_url('assets/site/css/');?>style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <!-- Favicon -->
  </head>
  <body>

<div class="topbar">
   <div class="container">
      <div class="mox_us">
         <div class="pull-left">
            <ul class="ul_set">
               <li><a href="#"><i class="fa fa-envelope"></i> <?=$businessData['business_email'];?></a></li>
               <li><a href="#"><i class="fa fa-phone"></i> <?=$businessData['business_phone'];?></a></li>
            </ul>
         </div>
         <div class="pull-right">
            <ul class="ul_set">
               <li><a href="#"><i class="fa fa-globe"></i> <?=site_url();?></a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<header>
   <div class="main_nav">
      <nav class="navbar navbar-default">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand logo_m" href="<?=site_url();?>">
               <img src="<?=site_url('assets/site/img/');?>logo_sims.png">
               </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?=site_url();?>">Home</a></li>
                  <li><a href="<?=site_url('About');?>">About Us</a></li>
                  <li><a href="<?=site_url('Services');?>">Services</a></li>
                  <li><a href="<?=site_url('Contact');?>">Contact Us</a></li>
               </ul>
            </div>
         </div>
      </nav>
   </div>
</header>