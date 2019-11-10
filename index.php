<?php
  session_start();
  if(@$_SESSION['status'] != "login"){
    // header("location:views/login.php");
    header("location:Controller/C_control.php?view=login");
  }
  else {
    // header("location:views/admin/home.php");
    header("location:Controller/C_control.php?view=home");
  }
 ?>
