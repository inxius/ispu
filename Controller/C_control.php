<?php
  session_start();
  include_once $_SERVER['DOCUMENT_ROOT']."/Controller/control.php";

  if (@$_GET['view']) {
    if ($_GET['view'] == 'login') {
      include_once '../views/login.php';
    }

    if ($_GET['view'] == 'logout') {
      include_once '../views/logout.php';
    }

    if ($_GET['view'] == 'home') {
      include_once '../views/admin/home.php';
    }

    if ($_GET['view'] == 'data_latih') {
      $data = $proses->get_DataLatih();
      include_once '../views/admin/data_latih.php';
    }

    if ($_GET['view'] == 'data_uji') {
      $data = $proses->get_DataUji();
      include_once '../views/admin/data_uji.php';
    }

    if ($_GET['view'] == 'pelatihan_bayes') {
      $dataParameter = $proses->get_Parameter_All();
      include_once '../views/admin/pelatihan.php';
    }

    if ($_GET['view'] == 'bayes') {
      include_once '../views/admin/pengujian_bayes.php';
    }
  }

  if (@$_GET['aksi']) {
    if ($_GET['aksi'] == 'tambah_dlatih') {
      $status = $_GET['status'];
      $data = $proses->get_DataLatih();
      include_once '../views/admin/data_latih.php';
    }

    if ($_GET['aksi'] == 'tambah_duji') {
      $status = $_GET['status'];
      $data = $proses->get_DataUji();
      include_once '../views/admin/data_latih.php';
    }

    if ($_GET['aksi'] == 'latih') {
      $data = $proses->pelatihan();
      $dataParameter = $proses->get_Parameter_All();
      include_once '../views/admin/pelatihan.php';
    }

    if ($_GET['aksi'] == 'uji_bayes') {
      $dataFitur = Array();
      $cek = $proses->cekData();
      if (!$cek) {
        $status = false;
        include_once '../views/admin/pengujian_bayes.php';
      }
      else {
        $dataUji = $proses->toArray($proses->get_DataUji());
        $dataParameterBaik = $proses->toArrayFiture($proses->get_Parameter_Where('baik'));
        $dataParameterSedang = $proses->toArrayFiture($proses->get_Parameter_Where('sedang'));
        $dataParameterTSehat = $proses->toArrayFiture($proses->get_Parameter_Where('tidak sehat'));
        $dataParameterSTSehat = $proses->toArrayFiture($proses->get_Parameter_Where('sangat tidak sehat'));
        array_push($dataFitur, $dataParameterBaik);
        array_push($dataFitur, $dataParameterSedang);
        array_push($dataFitur, $dataParameterTSehat);
        array_push($dataFitur, $dataParameterSTSehat);
        include_once '../views/admin/uji_bayes.php';
      }
    }
  }

  if (@$_POST['aksilogin']) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass1 = md5($pass);

    $login = $proses->login($email, $pass1);
    header('location:../index.php');
  }

  if (@$_POST['upload']) {
    $aksi = $_POST['aksi'];
    $id_petugas = @$_SESSION['id_petugas'];
    $target_dir = "../temp/";
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

    if (!$status) {
      if (strcasecmp($aksi, 'latih') == 0) {
        header("location:C_control.php?aksi=tambah_dlatih&status=gagal");
      }

      if (strcasecmp($aksi, "uji") == 0) {
        header("location:C_control.php?aksi=tambah_duji&status=gagal");
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
          header("location:C_control.php?aksi=tambah_dlatih&status=berhasil");
        }

        if (strcasecmp($aksi, 'uji') == 0) {
          header("location:C_control.php?aksi=tambah_duji&status=berhasil");
        }
      }
      else {
        if (strcasecmp($aksi, 'latih') == 0) {
          header("location:C_control.php?aksi=tambah_dlatih&status=gagal");
        }

        if (strcasecmp($aksi, 'uji') == 0) {
          header("location:C_control.php?aksi=tambah_duji&status=gagal");
        }
      }

    }
  }
  
 ?>