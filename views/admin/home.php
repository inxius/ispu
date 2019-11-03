<?php
  require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <style media="screen">
    .content-home {
      /* padding: 20%; */
      margin-top: 12%;
      margin-bottom: 14%;
    }
    </style>
  </head>
  <body>
    <!-- <h1>HAIIIII</h1>
    <a href="../logout.php">Logout</a> -->
    <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
      <?php
        include 'navbar.php';
       ?>
    </nav>
    <div class="jumbotron jumbotron-fluid bg-dark">
      <div class="jumbotron-background">
        <img src="../../assets/img/color1.jpg" class="blur ">
      </div>

      <div class="container content-home">
        <div class="row d-flex justify-content-center align-items-center">
          <h1 class="text-center">PERBANDINGAN METODE NAIVE BAYES CLASSIFIER DAN K-NEAREST NEIGHBOR PADA KLASIFIKASI KUALITAS UDARA</h1>
        </div>
      </div>
    </div>
  </body>
</html>
