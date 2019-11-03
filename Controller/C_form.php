<?php
  // require_once('../model/M_db.php');
  include_once $_SERVER['DOCUMENT_ROOT']."/Controller/control.php";
  // include_once 'C_proses.php';
  // $sql = new M_db();
  // $proses = new c_proses($db);

  if (@$_POST['login']) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass1 = md5($pass);

    $login = $proses->login($email, $pass1);
    if (!$login) {
      header('location:../index.php');
    }
    else {
      header('location:../views/admin/home.php');
    }
  }

  if (@$_POST['upload']) {
    $aksi = $_POST['aksi'];
    $id_petugas = @$_SESSION['id_petugas'];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/temp";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $status = true;

    if (file_exists($target_file)) {
      $status = false;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
      $status = false;
    }

    if ($fileType != "csv") {
      $status = false;
    }

    if ($status == false) {
      if (strcasecmp($aksi, 'latih') == 0) {
        header("location:../views/admin/data_latih.php?gagal");
      }

      if (strcasecmp($aksi, "uji") == 0) {
        header("location:../views/admin/data_uji.php?gagal");
      }
    }
    else {
      echo "HHH";
    }
  }
 ?>
