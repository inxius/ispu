<?php
session_start();
ob_start();
ob_end_clean();
session_destroy();
header("location:../Controller/C_control.php?view=login");
 ?>
