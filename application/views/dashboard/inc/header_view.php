<!doctype html>
<html lang="en">
<head>
    <title>CodeIgniter App</title>
    <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css" />
    
    <script src="<?=base_url()?>public/js/jquery.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap.js"></script>

    <script src="<?=base_url()?>public/js/oli/dashboard/result.js"></script>
    <script src="<?=base_url()?>public/js/oli/dashboard/event.js"></script>
    <script src="<?=base_url()?>public/js/oli/dashboard/template.js"></script>
    <script src="<?=base_url()?>public/js/oli/dashboard.js"></script>
    <script>
    $(function() {
        // Init the Dashboard Application
        var dashboard = new Dashboard();
    });
    </script>
</head>
<body>
    
<nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">User</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('dashboard/logout') ?>">Logout</a>
    </li>
  </ul>

</nav>

<header>
  <div class="jumbotron">
    <h1 class="text-center">Oli's CI App</h1>
  </div>
  <hr>
</header>
    
<!-- start:wrapper -->
<div class="container">
    
    <div id="error" class="alert alert-danger hide"></div>
    <div id="success" class="alert alert-success hide"></div>


