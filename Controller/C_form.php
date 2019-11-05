<?php
  session_start();
  include_once $_SERVER['DOCUMENT_ROOT']."/Controller/control.php";

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
    $target_dir = "../temp/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $filename = basename($_FILES["fileToUpload"]["name"]);
    // echo $target_file;
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

    if (!$status) {
      if (strcasecmp($aksi, 'latih') == 0) {
        header("location:../views/admin/data_latih.php?gagal");
        // echo "gggl";
      }

      if (strcasecmp($aksi, "uji") == 0) {
        header("location:../views/admin/data_uji.php?gagal");
      }
    }
    else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $upload = $proses->uploadFileToDB($filename, $id_petugas, $aksi);
        if ($upload == false) {
          $status = false;
        }
        unlink($target_file);
      }
      else {
        $status = false;
      }

      if ($status == true) {
        if (strcasecmp($aksi, 'latih') == 0) {
          header("location:../views/admin/data_latih.php?berhasil");
          echo $status;
        }

        if (strcasecmp($aksi, 'uji') == 0) {
          header("location:../views/admin/data_uji.php?berhasil");
        }
      }
      else {
        if (strcasecmp($aksi, 'latih') == 0) {
          header("location:../views/admin/data_latih.php?gagal");
        }

        if (strcasecmp($aksi, 'uji') == 0) {
          header("location:../views/admin/data_uji.php?gagal");
        }
      }

    }
  }

  if (@$_GET['uji']) {
    $metode = $_GET['metode'];

    if (strcasecmp($metode, 'bayes') == 0) {
      $dataFitur = Array();
      $cek = $proses->cekData();
      if (!$cek) {
        header("location:../views/admin/pengujian_bayes.php?ujigagal");
      }

      $dataUji = $proses->toArray($proses->get_DataUji());
      $dataParameterBaik = $proses->toArrayFiture($proses->get_Parameter_Where('baik'));
      $dataParameterSedang = $proses->toArrayFiture($proses->get_Parameter_Where('sedang'));
      $dataParameterTSehat = $proses->toArrayFiture($proses->get_Parameter_Where('tidak sehat'));
      $dataParameterSTSehat = $proses->toArrayFiture($proses->get_Parameter_Where('sangat tidak sehat'));
      array_push($dataFitur, $dataParameterBaik);
      array_push($dataFitur, $dataParameterSedang);
      array_push($dataFitur, $dataParameterTSehat);
      array_push($dataFitur, $dataParameterSTSehat);
      // $_SESSION['dataUji'] = $dataUji;
      // $_SESSION['dataFitur'] = $dataFitur;
      // header("location:../views/admin/uji_bayes.php");
      include_once '../views/admin/uji_bayes.php';
    }
  }
 ?>
