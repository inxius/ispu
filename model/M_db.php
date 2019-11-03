<?php
  class M_db
  {
    private $host =  "127.0.0.1";
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

    function action_Select_Where($table, $where, $key){
      $db = $this->mysqli;
      $sql = "SELECT * FROM ".$table." WHERE ".$where." = '".$key."'";
      $query = $db->query($sql) or die ($db->error);
      return $query;
    }
  }

 ?>
