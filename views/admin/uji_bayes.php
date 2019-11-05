<?php
  // session_start();
  // if (!isset($_SESSION['dataFitur']) || !isset($_SESSION['dataUji'])) {
  //   header("location:pengujian_bayes.php");
  // }
  // $dataFitur = json_encode($_SESSION['dataFitur']);
  // $dataUji = json_encode($_SESSION['dataUji']);
  // echo count($_SESSION['dataUji']);
  // unset($_SESSION['dataFitur']);
  // unset($_SESSION['dataUji']);
  $dataFiturEnc = json_encode($dataFitur);
  $dataUjiEnc = json_encode($dataUji);
  echo "<pre>";
  print_r($dataUji);
  echo "</pre>";
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>UJI NAIVE BAYES</title>

     <script type="text/javascript" src="../../Controller/C_math.js"></script>
     <script type="text/javascript">
     var fitur = JSON.parse('<?= $dataFiturEnc; ?>');
     var dataUji = JSON.parse('<?= $dataUjiEnc; ?>');
     var probFitur = u_getProb(fitur, dataUji);
     var likelihood = u_getLilelihood(probFitur);
     var probAkhir = u_getProbAkhir(likelihood);
     var KatBayes = u_getKatBayes(probAkhir, dataUji);
     var akurasiBayes = u_getAkurasiBayes(KatBayes);
     console.log(akurasiBayes);
     </script>
   </head>
   <body>

   </body>
 </html>
