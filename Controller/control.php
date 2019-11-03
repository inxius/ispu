<?php
include_once $_SERVER['DOCUMENT_ROOT']."/model/M_db.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Controller/C_proses.php";

  $db = new M_db();
  $proses = new c_proses($db);
 ?>
