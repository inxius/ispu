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


  // include 'model/M_db.php';
  // include 'Controller/C_proses.php';
  // $db = new M_db();
  // $proses = new C_proses($db);
  // $proses->tes();
  // $data = $proses->get_Parameter_All();
  // echo "<pre>";
  // print_r($data);
  // echo "</pre>";
 ?>
