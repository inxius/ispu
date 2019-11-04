<?php
  // include_once '../model/M_db.php';
  // include_once $_SERVER['DOCUMENT_ROOT']."/model/M_db.php";
  /**
   *
   */
  class c_proses
  {
    private $DBS;
    function __construct($db)
    {
      $this->DBS = $db;
    }

    public function Tes(){
      if (!$this->DBS) {
        echo "Gagl";
      }
      else {
        echo "OK";
      }
    }

    public function login($email, $pass){
      $cekLogin = $this->DBS->action_Select_Where("tb_petugas", "email", $email);
      if (mysqli_num_rows($cekLogin) == 1) {
        $row = mysqli_fetch_assoc($cekLogin);
        $tesEmail = $row['email'];
        $tesPass = $row['password'];
        $name = $row['nama'];
        $id_petugas = $row['id_petugas'];

        if ($email == $tesEmail && $pass == $tesPass) {
          session_start();
          $_SESSION['status'] = "login";
          $_SESSION['name'] = $name;
          $_SESSION['id_petugas'] = $id_petugas;
          return true;
        }
        else {
          return false;
        }
      }
      else {
        return false;
      }
    }

    public function uploadFileToDB($filename, $id_petugas, $filter){
      $dataArray = $this->convertToArray($filename);
      $upload = $this->getNormalData($dataArray, $id_petugas, $filter);
      return $upload;
    }

    public function convertToArray($filename){
      $file = '../temp/'.$filename;
      $csv = array();
      $csv = array_map('str_getcsv', file($file));
      return $csv;
    }

    public function getNormalData($data, $id_petugas, $filter){
      $pm10 = -10;
      $so2 = -10;
      $co = -10;
      $o3 = -10;
      $no2 = -10;
      $kat = -10;
      $tanggal = -10;
      $y = date('Y');
      $m = date('m');
      $d = date('d');
      $today = $y."-".$m."-".$d;
      $iterasi = count($data[0]);
      for ($i=0; $i < $iterasi; $i++) {
        if (strcasecmp($data[0][$i], 'tanggal') == 0) {
          $tanggal = $i;
        }

        if (strcasecmp($data[0][$i], 'pm10') == 0) {
          $pm10 = $i;
        }

        if (strcasecmp($data[0][$i], 'so2') == 0 || strcasecmp($data[0][$i], 's02') == 0) {
          $so2 = $i;
        }

        if (strcasecmp($data[0][$i], 'co') == 0) {
          $co = $i;
        }

        if (strcasecmp($data[0][$i], 'o3') == 0) {
          $o3 = $i;
        }

        if (strcasecmp($data[0][$i], 'no2') == 0) {
          $no2 = $i;
        }

        if (strcasecmp($data[0][$i], 'categori') == 0 || strcasecmp($data[0][$i], 'kategori') == 0) {
          if (strcasecmp($data[1][$i], 'baik') == 0 || strcasecmp($data[1][$i], 'sedang') == 0 || strcasecmp($data[1][$i], 'tidak sehat') == 0
              || strcasecmp($data[1][$i], 'sangat tidak sehat') == 0 || strcasecmp($data[1][$i], 'tidak ada data') == 0) {
            $kat = $i;
          }
        }

        if (strcasecmp($data[0][$i], 'keterangan') == 0) {
          if (strcasecmp($data[1][$i], 'baik') == 0 || strcasecmp($data[1][$i], 'sedang') == 0 || strcasecmp($data[1][$i], 'tidak sehat') == 0
              || strcasecmp($data[1][$i], 'sangat tidak sehat') == 0 || strcasecmp($data[1][$i], 'tidak ada data') == 0) {
            $kat = $i;
          }
        }

      }

      if ($pm10 == -10 || $so2 == -10 || $co == -10 || $o3 == -10 || $no2 == -10 || $kat == -10 || $kat == -10) {
        return false;
      }
      else {
        for ($i=0; $i < count($data); $i++) {
          if (strtolower($data[$i][$kat] != "tidak ada data")) {
            if (is_numeric($data[$i][$pm10]) && is_numeric($data[$i][$so2]) && is_numeric($data[$i][$co]) &&
                is_numeric($data[$i][$o3]) && is_numeric($data[$i][$no2])) {
              if (strcasecmp($filter, "latih") == 0) {
                $this->DBS->addToDBLatih($id_petugas, $data[$i][$pm10], $data[$i][$so2], $data[$i][$co], $data[$i][$o3], $data[$i][$no2], strtolower($data[$i][$kat]), $data[$i][$tanggal], $today);
              }

              if (strcasecmp($filter, "uji") == 0) {
                // code...
              }
            }
          }
        }
        return true;
      }
    }

    public function get_DataLatih(){
      $data = $this->DBS->action_Select("tb_data_latih");
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_Petugas_All(){
      return $this->DBS->action_Select("tb_petugas");
    }

    public function get_Parameter_All(){
      return $this->DBS->action_Select("tb_parameter");
    }
  }

 ?>
