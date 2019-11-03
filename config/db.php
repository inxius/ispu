<?php
  /**
   *
   */
  class Db
  {
    public $conn;

    function __construct()
    {
      $host =  "127.0.0.1";
      $user =  "root";
      $pass =  "Jafar_001";
      $database =  "db_ispu";

      $this->conn = new mysqli($host, $user, $pass, $database) or die (mysqli_error());

      if ($this->conn == false) {
        return false;
      }
      else {
        return true;
      }
    }
  }

 ?>
