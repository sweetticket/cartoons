<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Children's Cartoons</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <script src="js/jquery.js"></script>
    <script src="js/packery.pkgd.min.js"></script>
</head>

<body>
    
<?php include("template/nav.php"); ?>

<div id="wrapper">
    <?php include('template/header.php'); ?>
    <div id="data_container">
    <?php
      echo '<ul>';
      $txt_file = file_get_contents('data.txt');
      $rows = explode("\n", $txt_file);
      foreach($rows as $row => $data){
          $row_data = explode('|', $data);
          $title = $row_data[0];
          $channel = $row_data[1];
          $airdate = $row_data[2];
          $current = $row_data[3];
          
          echo '<li class="item">' . '<span class="label">Title: </span>' . $title . '<br><span class="label">Channel: </span>' . $channel . '<br><span class="label">First aired: </span>' . $airdate . '<br><span class="label">Still airing: </span>' . $current . '</li>';
      }
      echo '</ul>';
      ?>
    </div>
</div>
<script src="js/display_data.js"></script>
</body>
</html>
