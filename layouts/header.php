<?php

include $lvl."functions/config.php";
define ('SITE_ROOT', realpath(dirname(__FILE__)));
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <title>Material Style</title>
    <meta name="description" content="Material Style Theme">
    <link rel="shortcut icon" href="<?php echo $lvl; ?>assets/img/favicon.png?v=3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo $lvl ?>assets/css/preload.min.css">
    <link rel="stylesheet" href="<?php echo $lvl ?>assets/css/plugins.min.css">
    <link rel="stylesheet" href="<?php echo $lvl ?>assets/css/style.light-blue-500.min.css">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
    .uploader2 {
        float: left;
        overflow:hidden;
        width: 90%;
        height: 400px;
        border: 2px solid #e8e8e8;
        border-radius: 25px;
    }
    .filePhoto{
        position:relative;
        width: 100%;
        height: 360px;
        top: -380px;
        left: 0px;
        z-index:2;
        opacity:0;
        cursor:pointer;
    }
    .uploader2 img{
        /* position:absolute; */
        width: 100%;
        height: 100%;
        z-index: 1;
        border: none;
        border-radius: 25px;
    }

    </style>
  </head>
  <body>
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">
      <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-primary navbar-mode"  style="height:70px">
        <div class="container container-full">
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo $lvl; ?>">
              <!-- <img src="assets/img/demo/logo-navbar.png" alt=""> -->
              <span class="ms-logo ms-logo-md" style="font-size:20px">SVM</span>
              <span class="ms-title">SupportVector
                <strong>Machine</strong>
              </span>
            </a>
          </div>
        </div>
        <!-- container -->
      </nav>
      <div class="material-background"></div>
