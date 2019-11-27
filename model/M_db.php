<?php
  class M_db
  {
    private $host =  "localhost";
    private $user =  "root";
    private $pass =  "Jafar_001";
    private $database =  "db_ispu";
    public $mysqli;

    function __construct()
    {
      $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->database) or die (mysqli_error());
    }


    function tes(){
      if (!$this->mysqli) {
        echo "Gagl";
      }
      else {
        echo "OK";
      }
    }

    function action_Select($table){
      $db = $this->mysqli;
      $sql = "SELECT * FROM ".$table;
      $query = $db->query($sql) or die ($db->error);
      return $query;
    }

    function action_SelectLimit($table){
      $db = $this->mysqli;
      $sql = "SELECT * FROM ".$table." limit 15";
      $query = $db->query($sql) or die ($db->error);
      return $query;
    }

    function action_SelectLimitNext($table, $next){
      $db = $this->mysqli;
      $sql = "SELECT * FROM ".$table." WHERE id > ".$next." limit 15";
      $query = $db->query($sql) or die ($db->error);
      return $query;
    }

    function action_Select_Where($table, $where, $key){
      $db = $this->mysqli;
      $sql = "SELECT * FROM ".$table." WHERE ".$where." = '".$key."'";
      $query = $db->query($sql) or die ($db->error);
      return $query;
    }

    function addToTBLatih($id_petugas, $pm10, $so2, $co, $o3, $no2, $kat, $tanggal_pengambilan, $tanggal_unggah){
      $db = $this->mysqli;
      $sql = "INSERT INTO tb_data_latih VALUES (NULL , '$id_petugas', '$pm10', '$so2', '$co', '$o3', '$no2', '$kat', '$tanggal_pengambilan', '$tanggal_unggah')";
      $query = $db->query($sql) or die ($db->error);
    }

    function addToTBUji($id_petugas, $pm10, $so2, $co, $o3, $no2, $kat, $tanggal_pengambilan, $tanggal_unggah){
      $db = $this->mysqli;
      $sql = "INSERT INTO tb_data_uji VALUES (NULL , '$id_petugas', '$pm10', '$so2', '$co', '$o3', '$no2', '$kat', '$tanggal_pengambilan', '$tanggal_unggah')";
      $query = $db->query($sql) or die ($db->error);
    }

    function addToTBTemp($id_petugas, $pm10, $so2, $co, $o3, $no2, $kat, $tanggal_pengambilan, $tanggal_unggah){
      $db = $this->mysqli;
      $sql = "INSERT INTO temp VALUES (NULL , '$id_petugas', '$pm10', '$so2', '$co', '$o3', '$no2', '$kat', '$tanggal_pengambilan', '$tanggal_unggah')";
      $query = $db->query($sql) or die ($db->error);
    }

    function updateParameter($filter, $data, $tanggal){
      $db = $this->mysqli;

      $sql = "UPDATE tb_parameter SET nilai = (CASE
        WHEN parameter = 'meanPM10' THEN '".$data[0]."'
        WHEN parameter = 'meanSO2' THEN '".$data[1]."'
        WHEN parameter = 'meanCO' THEN '".$data[2]."'
        WHEN parameter = 'meanO3' THEN '".$data[3]."'
        WHEN parameter = 'meanNO2' THEN '".$data[4]."'
        WHEN parameter = 's2PM10' THEN '".$data[5]."'
        WHEN parameter = 's2SO2' THEN '".$data[6]."'
        WHEN parameter = 's2CO' THEN '".$data[7]."'
        WHEN parameter = 's2O3' THEN '".$data[8]."'
        WHEN parameter = 's2NO2' THEN '".$data[9]."'
        WHEN parameter = 'pkategori' THEN '".$data[10]."' END)
        WHERE kategori = '".$filter."'";

        $db->query($sql) or die ($db->error);
        $sql2 = "UPDATE tb_parameter SET tgl_pelatihan = '".$tanggal."'";
        $db->query($sql2) or die ($db->error);
    }

    function countDataTable($table){
      $db = $this->mysqli;
      $sql = "SELECT COUNT(*) FROM ".$table;
      $query = $db->query($sql) or die($db->error);
      return $query;
    }

    function countDataTableWhere($table, $where, $key){
      $db = $this->mysqli;
      $sql = "SELECT COUNT(*) FROM ".$table." WHERE ".$where." = '".$key."'";
      $query = $db->query($sql) or die($db->error);
      return $query;
    }
  }

 ?>
