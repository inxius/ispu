<?php
  session_start();
  if(@$_SESSION['status'] != "login"){
      header("location:views/login.php");
  }
  else {
    header("location:views/admin/home.php");
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
