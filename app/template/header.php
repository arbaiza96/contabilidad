<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CONTABILIDAD</title>
    <?php 
      $dir = 'http://localhost/contabilidad/';
      $file = explode("/",$_SERVER['SCRIPT_NAME'])[count(explode("/",$_SERVER['SCRIPT_NAME']))-1];
    ?>

    <style>
      *{
        border-radius: 0 !important;
      }
      .spinner-border{
        border-radius: 50% !important;
      }
    </style>
    <!--  fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="<?=$dir?>plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$dir?>plugins/alertify/css/alertify.min.css">
    <link rel="stylesheet" href="<?=$dir?>plugins/alertify/css/themes/default.min.css">
    <link rel="stylesheet" href="<?=$dir?>dist/css/adminlte.css">
    <!-- js -->
    <script src="<?=$dir?>plugins/jquery/jquery.min.js"></script>
    <script src="<?=$dir?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$dir?>plugins/alertify/alertify.min.js"></script>
    <script src="<?=$dir?>dist/js/adminlte.min.js"></script>
  </head>
  <body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block" style='display: none !important;'>
            <a href="index3.html" class="nav-link">Home</a>
          </li>
        </ul>
        <!-- Right navbar links -->
      </nav>
      <!-- /.navbar -->