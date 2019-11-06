<?php
session_start();
if(@$_SESSION['status'] != "login"){
  header("location:../../Controller/C_control.php?view=login");
}
else {
  header("location:../../Controller/C_control.php?view=home");
}
 ?>
