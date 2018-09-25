<!doctype html>
<html lang="en">
<head>
    <title>Oli's Todo and Note Taking App</title>
    <link rel="stylesheet" href="<?=base_url()?>public/third-party/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

    
    <script src="<?=base_url()?>public/third-party/js/jquery.js"></script>
    <script src="<?=base_url()?>public/third-party/js/bootstrap.js"></script>

    <script src="<?=base_url()?>public/js/dashboard/result.js"></script>
    <script src="<?=base_url()?>public/js/dashboard/event.js"></script>
    <script src="<?=base_url()?>public/js/dashboard/template.js"></script>
    <script src="<?=base_url()?>public/js/dashboard.js"></script>
    <script>
    $(function() {
        // Init the Dashboard Application
        var dashboard = new Dashboard();
    });
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="http://oli.net.in"><img id="navbar_brand_img" src="<?php echo base_url(); ?>public/third-party/img/pencil-8x.png"> Simple Todo and Note Taking App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item acive">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">User</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('dashboard/logout') ?>">Logout</a>
    </li>
    </ul>

  </div>
</nav>

<div id="header">
    <div class="jumbotron jumbotron-billboard ">
      <div class="img">
        <h2 style="font-family: 'Patrick Hand', cursive;" class="text-center jumbotron-header" style=>Simple Todo and Note Taking App</h2>
      </div>
      <hr>
      <p style="font-family: 'Patrick Hand', cursive;" class="text-center lead">A Todo and Note taking solution for minimalists </p>
  </div>
</div id="header">
    
<!-- start:wrapper -->
<div class="container">
    
    <div id="error" class="alert alert-danger hide"></div>
    <div id="success" class="alert alert-success hide"></div>


