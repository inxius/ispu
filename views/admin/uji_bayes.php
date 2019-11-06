<?php
  $dataFiturEnc = json_encode($dataFitur);
  $dataUjiEnc = json_encode($dataUji);
  // echo "<pre>";
  // print_r($dataUji);
  // echo "</pre>";
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Nive Bayes - Pengujian Data Uji</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/css/custom.css">

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
     <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
       <?php
       include "navbar.php";
       unset($dataUjiEnc);
       unset($dataLatihEnc);
       ?>
     </nav>

     <div class="jumbotron jumbotron-fluid bg-dark">
       <div class="jumbotron-background">
         <img src="../../assets/img/color1.jpg" class="blur ">
       </div>

       <div class="container content">
         <div class="border-bottom d-flex justify-content-center align-items-center">
           <h1 style="color:white;"><b>Hasil Pengujian Data Uji Dengan Metode Naive Bayes</b></h1>
         </div>
         <br>
         <div class="row d-flex justify-content-center align-items-center">
           <div class="col-md-6 col-sm-6 text-center">
             <h1 style="color:white;"><b><script>document.write("Akurasi = "+akurasiBayes[0])</script> %</b></h1>
           </div>
         </div>
         <div class="row d-flex justify-content-center align-items-center">
           <div class="col-md-3 col-sm-3 text-left">
             <ul>
               <li>Total Data Uji = <script>document.write(akurasiBayes[1])</script></li>
               <li>Benar = <script>document.write(akurasiBayes[2])</script></li>
               <li>Salah = <script>document.write(akurasiBayes[3])</script></li>
             </ul>
             <br>
             <button class="showButton show btn btn-primary btn-full" name="tampil">Tampilkan Perhitungan</button>
             <button class="hideButton hidden btn btn-primary btn-full" name="hide">Sembunyikan Perhitungan</button>
           </div>
         </div>
       </div>
     </div>
   </body>
 </html>
