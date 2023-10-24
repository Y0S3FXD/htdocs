<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php appName(); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


  <!-- Custom Assets 

  <link rel="stylesheet" href="<?php //echo FRONTEND_ASSET . 'css/profile.css'; ?>">
-->
  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
  </style>
</head>

<body>

<div class="jumbotron text-center p-3 mb-2 bg-success text-white" style="margin-bottom:p-3 mb-2 bg-success text-white">
<div class="p-3 mb-2 bg-success text-white"></div>
  <h1> <?php appName(); ?></h1>
  <p>Resize this responsive page to see the effect!</p>
  <?php if ($user->isLoggedIn()) : ?>
    <h3 align="right">Hello, <?php echo $user->data()->name; ?> Welcome To php worlds </h3>
  <?php endif; ?>
</div>
