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
