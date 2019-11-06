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
     <title>Naive Bayes - Pengujian Data Uji</title>
     <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../assets/css/custom.css">

     <style type="text/css">
     body {
       justify-content: center;
       color: #fff;
       /* text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5); */
       box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
       /* background-color: #333; */
       padding: 0;
       margin: 0;
     }

     .hidden{
       display: none;
     }
     </style>

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

     <div class="hidden">
       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="border-bottom d-flex justify-content-center align-items-center">
             <h1 style="color:white;"><b>Nilai Parameter</b></h1>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-3 col-sm-3 text-center">
               <h2 style="color:white;"><b>Baik</b></h2>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <thead class="border-bottom">
                   <tr>
                     <th class="" width="150px">Parameter</th>
                     <th class="text-center" width="150px">Nilai</th>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                <?php while ($row = mysqli_fetch_array($dataParameterBaik)) {
                  ?>
                  <tr>
                    <td class="text-center" width="170px"><?php echo $row['parameter']; ?></td>
                    <td class="text-center" width="120px"><?php echo $row['nilai']; ?></td>
                  </tr>
                  <?php
                } ?>
                 </tbody>
               </table>
             </div>

             <div class="col-md-3 col-sm-3 text-center border-left">
               <h2 style="color:white;"><b>Sedang</b></h2>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <thead class="border-bottom">
                   <tr>
                     <th class="" width="150px">Parameter</th>
                     <th class="text-center" width="150px">Nilai</th>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                <?php while ($row = mysqli_fetch_array($dataParameterSedang)) {
                  ?>
                  <tr>
                    <td class="text-center" width="170px"><?php echo $row['parameter']; ?></td>
                    <td class="text-center" width="120px"><?php echo $row['nilai']; ?></td>
                  </tr>
                  <?php
                } ?>
                 </tbody>
               </table>
             </div>

             <div class="col-md-3 col-sm-3 text-center border-left">
               <h2 style="color:white;"><b>Tidak Sehat</b></h2>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <thead class="border-bottom">
                   <tr>
                     <th class="" width="150px">Parameter</th>
                     <th class="text-center" width="150px">Nilai</th>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                <?php while ($row = mysqli_fetch_array($dataParameterTSehat)) {
                  ?>
                  <tr>
                    <td class="text-center" width="170px"><?php echo $row['parameter']; ?></td>
                    <td class="text-center" width="120px"><?php echo $row['nilai']; ?></td>
                  </tr>
                  <?php
                } ?>
                 </tbody>
               </table>
             </div>

             <div class="col-md-3 col-sm-3 text-center border-left">
               <h4 style="color:white;"><b>Sangat Tidak Sehat</b></h4>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <thead class="border-bottom">
                   <tr>
                     <th class="" width="150px">Parameter</th>
                     <th class="text-center" width="150px">Nilai</th>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                <?php while ($row = mysqli_fetch_array($dataParameterSTSehat)) {
                  ?>
                  <tr>
                    <td class="text-center" width="170px"><?php echo $row['parameter']; ?></td>
                    <td class="text-center" width="120px"><?php echo $row['nilai']; ?></td>
                  </tr>
                  <?php
                } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="border-bottom d-flex justify-content-center align-items-center">
             <h1 style="color:white;"><b>Perhitungan Naive Bayes</b></h1>
           </div>
           <div class="border-bottom d-flex justify-content-center align-items-center">
             <h3 style="color:white;"><b>1. Perhitungan Probabilitas Setiap Fitur</b></h3>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(PM10 | BAIK)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][2]." - ".$dataFiturBaik[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][0][0])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(PM10 | SEDANG)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][2]." - ".$dataFiturSedang[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][1][0])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(PM10 | TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][2]." - ".$dataFiturTSehat[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][2][0])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(PM10 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][2]." - ".$dataFiturSTSehat[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][3][0])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>


       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(SO2 | BAIK)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][3]." - ".$dataFiturBaik[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][0][1])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(SO2 | SEDANG)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][3]." - ".$dataFiturSedang[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][1][1])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(SO2 | TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][3]." - ".$dataFiturTSehat[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][2][1])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(SO2 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][3]." - ".$dataFiturSTSehat[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][3][1])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(CO | BAIK)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][4]." - ".$dataFiturBaik[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][0][2])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(CO | SEDANG)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][4]." - ".$dataFiturSedang[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][1][2])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(CO | TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][4]." - ".$dataFiturTSehat[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][2][2])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(CO | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][4]." - ".$dataFiturSTSehat[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][3][2])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(O3 | BAIK)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][5]." - ".$dataFiturBaik[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][0][3])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(O3 | SEDANG)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][5]." - ".$dataFiturSedang[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][1][3])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(O3 | TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][5]." - ".$dataFiturTSehat[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][2][3])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(O3 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][5]." - ".$dataFiturSTSehat[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][3][3])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(NO2 | BAIK)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][6]." - ".$dataFiturBaik[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][0][4])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(NO2 | SEDANG)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][6]." - ".$dataFiturSedang[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][1][4])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(NO2 | TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][6]." - ".$dataFiturTSehat[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][2][4])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(NO2 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr class="d-flex align-items-center">
                     <td><?php echo "DT".($i+1); ?></td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataUji[$i][6]." - ".$dataFiturSTSehat[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probFitur[<?php echo $i; ?>][3][4])</script></td>
                   </tr>
                   <?php
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="border-bottom border-top d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>2. Perhitungan Likelihood</b></h3>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-12 col-sm-12 text-left">
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr>
                     <td colspan="4" class="text-center"><?php echo "DT".($i+1); ?></td>
                   </tr>
                   <?php
                   for ($j=0; $j < 4; $j++) {
                     echo "<tr>";
                     if ($j == 0) {
                       echo "<td>Baik</>";
                     }
                     if ($j == 1) {
                       echo "<td>Sedang</>";
                     }
                     if ($j == 2) {
                       echo "<td>Tidak Sehat</>";
                     }
                     if ($j == 3) {
                       echo "<td>Sangat Tidak Sehat</>";
                     }
                     ?>
                     <td>
                       <script>
                       document.write(probFitur[<?php echo $i; ?>][<?php echo $j; ?>][0]+" X "+probFitur[<?php echo $i; ?>][<?php echo $j; ?>][1]+
                       " X "+probFitur[<?php echo $i; ?>][<?php echo $j; ?>][2]+" X "+probFitur[<?php echo $i; ?>][<?php echo $j; ?>][3]+
                       " X "+probFitur[<?php echo $i; ?>][<?php echo $j; ?>][4]+" X "+probFitur[<?php echo $i; ?>][<?php echo $j; ?>][5]);
                       </script>
                     </td>
                     <td>=</td>
                     <td><script>document.write(likelihood[<?php echo $i; ?>][<?php echo $j; ?>]);</script></td>
                     <?php
                     echo "<tr>";
                   }
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="border-bottom border-top d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>3. Perhitungan Probabilitas Akhir</b></h3>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-12 col-sm-12 text-left">
               <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                 <?php
                 // for ($i=0; $i < count($dataUji); $i++) {
                 for ($i=0; $i < 10; $i++) {
                   ?>
                   <tr >
                     <td colspan="4" class="text-center"><?php echo "DT".($i+1); ?></td>
                   </tr>
                   <?php
                   for ($j=0; $j < 4; $j++) {
                     echo '<tr class="text-left">';
                     if ($j == 0) {
                       ?>
                       <td>Baik</td>
                       <td> <h5> =
                         <sup><script>document.write(likelihood[<?php echo $i; ?>][0]);</script></sup>&frasl;
                         <sub><script>document.write(likelihood[<?php echo $i; ?>][0]+"+"+likelihood[<?php echo $i; ?>][1]+
                         "+"+likelihood[<?php echo $i; ?>][2]+"+"+likelihood[<?php echo $i; ?>][3]);</script></sub>
                       </h5> </td>
                       <td> = <script>document.write(probAkhir[<?php echo $i; ?>][<?php echo $j; ?>]);</script></td>
                       <?php
                     }
                     if ($j == 1) {
                       ?>
                       <td>Sedang</td>
                       <td> <h5> =
                         <sup><script>document.write(likelihood[<?php echo $i; ?>][1]);</script></sup>&frasl;
                         <sub><script>document.write(likelihood[<?php echo $i; ?>][0]+"+"+likelihood[<?php echo $i; ?>][1]+
                         "+"+likelihood[<?php echo $i; ?>][2]+"+"+likelihood[<?php echo $i; ?>][3]);</script></sub>
                       </h5> </td>
                       <td> = <script>document.write(probAkhir[<?php echo $i; ?>][<?php echo $j; ?>]);</script></td>
                       <?php
                     }
                     if ($j == 2) {
                       ?>
                       <td>Tidak Sehat</td>
                       <td> <h5> =
                         <sup><script>document.write(likelihood[<?php echo $i; ?>][2]);</script></sup>&frasl;
                         <sub><script>document.write(likelihood[<?php echo $i; ?>][0]+"+"+likelihood[<?php echo $i; ?>][1]+
                         "+"+likelihood[<?php echo $i; ?>][2]+"+"+likelihood[<?php echo $i; ?>][3]);</script></sub>
                       </h5> </td>
                       <td> = <script>document.write(probAkhir[<?php echo $i; ?>][<?php echo $j; ?>]);</script></td>
                       <?php
                     }
                     if ($j == 3) {
                       ?>
                       <td>Sangat Tidak Sehat</td>
                       <td> <h5> =
                         <sup><script>document.write(likelihood[<?php echo $i; ?>][3]);</script></sup>&frasl;
                         <sub><script>document.write(likelihood[<?php echo $i; ?>][0]+"+"+likelihood[<?php echo $i; ?>][1]+
                         "+"+likelihood[<?php echo $i; ?>][2]+"+"+likelihood[<?php echo $i; ?>][3]);</script></sub>
                       </h5> </td>
                       <td> = <script>document.write(probAkhir[<?php echo $i; ?>][<?php echo $j; ?>]);</script></td>
                       <?php
                     }
                     echo "</tr>";
                   }
                 }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="border-bottom border-top d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>4. Pengklasifikasian</b></h3>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-12 col-sm-12 text-left">
               <table class="table table-responsive table-borderless table-striped">
                 <tr>
                   <td>Data</td>
                   <td>Terget Klasifikasi</td>
                   <td>Hasil Klasifikasi</td>
                   <td>Benar / Salah</td>
                 </tr>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <?php
                   for ($i=0; $i < count($dataUji); $i++) {
                     ?>
                     <tr>
                       <td><?php echo "DT".($i+1); ?></td>
                       <td><?php echo $dataUji[$i][7] ?></td>
                       <td><script>document.write(KatBayes[<?php echo $i; ?>][0])</script></td>
                       <td><script>document.write(KatBayes[<?php echo $i; ?>][1])</script></td>
                     </tr>
                     <?php
                   }
                   ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>


     </div>

     <script type="text/javascript">
       $(function(){
         $('.showButton').click(function(){
           $('.hidden').show();
           $('.show').hide();
         });

         $('.hideButton').click(function(){
           $('.hidden').hide();
           $('.show').show();
         });
       });
     </script>
   </body>
 </html>
