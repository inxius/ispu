<?php
  include_once 'session.php';
  $dataFiturEnc = json_encode($dataFitur);
  $dataTesEnc = json_encode($dataTes);

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Naive Bayes - Pengujian 1 Data</title>
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
       display:none;
     }
     </style>

     <script type="text/javascript" src="../../Controller/C_math.js"></script>
     <script type="text/javascript">
     var fitur = JSON.parse('<?= $dataFiturEnc; ?>');
     var dataTes = JSON.parse('<?= $dataTesEnc; ?>');
     var probability = k_getProb(fitur, dataTes);
     var likelihood = k_getLikelihood(probability);
     var probAkhir = k_getProbAkhir(likelihood);
     var katBayes = k_getKat(probAkhir);
     console.log(fitur);
     console.log(probAkhir);

     var kat_baik = ["Tidak ada efek kesehatan pada manusia", "Sedikit berbau", "Luka pada beberapa spesies tumbuhan"];
     var kat_sedang = ["Perubahan kimia pada darah namun tidak terdeteksi", "Berbau", "Luka pada Babarapa spesies tumbuhan", "Terjadi penurunan pada jarak pandang"];
     var kat_TSehat = ["Peningkatan pada kardiovaskular pada perokok yang sakit jantung", "Berbau", "Peningkatan reaktivitas pembuluh tenggorokan pada penderita asma", "Penurunan kemampuan pada atlit yang berlatih keras", "Meningkatnya kerusakan tanaman", "Jarak pandang turun dan terjadi pengotoran debu di mana-mana"];
     var kat_STSehat = ["Maningkatnya kardiovaskular pada orang bukan perokok yang berpanyakit Jantung, dan akan tampak beberapa kalemahan yang terlihat secara nyata", "Meningkatnya sensitivitas pasien yang berpenyaklt asma dan bronhitis", "Olah raga ringan mangakibatkan pengaruh parnafasan pada pasien yang berpenyaklt paru-paru kronis"];

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
           <h1>Hasil Pengujian 1 Data Dengan Metode Naive Bayes</h1>
         </div>
         <br>

         <div class="row d-flex justify-content-center align-items-center">
           <div class="col-md-6 col-sm-6 text-center">
             <h1><script>document.write("Klasifikasi = "+katBayes);</script></h1>
             <br>
             <table class="table d-flex justify-content-center align-items-center">
               <tr>
                 <td>PM10 = <?php echo $dataTes[0]; ?></td>
                 <td> SO2 = <?php echo $dataTes[1]; ?></td>
                 <td> CO = <?php echo $dataTes[2]; ?></td>
                 <td> O3 = <?php echo $dataTes[3]; ?></td>
                 <td> NO2 = <?php echo $dataTes[4]; ?></td>
               </tr>
             </table>
             <br>
             <button class="showButton show btn btn-primary btn-full" name="tampil">Tampilkan Perhitungan</button>
             <button class="hideButton hidden btn btn-primary btn-full" name="hide">Sembunyikan Perhitungan</button>
           </div>

           <div class="col-md-6 col-sm-6 row d-flex justify-content-center">
             <h3>Pengaruh Tingkat Pencemaran Udara</h3>
             <hr>
             <div class="text-left">
               <ul>
                 <script type="text/javascript">
                 if (katBayes == "baik") {
                   for (var i = 0; i < kat_baik.length; i++) {
                     document.write('<li>'+kat_baik[i]+'</li>');
                   }
                 }
                 if (katBayes == "sedang") {
                   for (var i = 0; i < kat_sedang.length; i++) {
                     document.write('<li>'+kat_sedang[i]+'</li>');
                   }
                 }
                 if (katBayes == "tidak sehat") {
                   for (var i = 0; i < kat_TSehat.length; i++) {
                     document.write('<li>'+kat_TSehat[i]+'</li>');
                   }
                 }
                 if (katBayes == "sangat tidak sehat") {
                   for (var i = 0; i < kat_STSehat.length; i++) {
                     document.write('<li>'+kat_STSehat[i]+'</li>');
                   }
                 }
                 </script>
               </ul>
             </div>
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
             <div class="col-md-4 col-sm-4 text-center">
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

             <div class="col-md-4 col-sm-4 text-center border-left">
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

             <div class="col-md-4 col-sm-4 text-center border-left">
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

           </div>
         </div>
       </div>

       <div class="jumbotron jumbotron-fluid bg-dark">
         <div class="jumbotron-background">
           <img src="../../assets/img/color1.jpg" class="blur ">
         </div>

         <div class="container content-small">
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-4 col-sm-4 text-center border-right">
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

             <div class="col-md-4 col-sm-4 text-center">
               <h4 style="color:white;"><b>Berbahaya</b></h4>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <thead class="border-bottom">
                   <tr>
                     <th class="" width="150px">Parameter</th>
                     <th class="text-center" width="150px">Nilai</th>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <?php while ($row = mysqli_fetch_array($dataParameterBerbahaya)) {
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

           <div class="border-bottom d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>1. Perhitungan Probabilitas Setiap Fitur</b></h3>
           </div>

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3>BAIK</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>pPM10</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[0]." - ".$dataFiturBaik[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[0][0]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pSO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[1]." - ".$dataFiturBaik[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[0][1]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pCO</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[2]." - ".$dataFiturBaik[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[0][2]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pO3</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[3]." - ".$dataFiturBaik[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[0][3]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pNO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[4]." - ".$dataFiturBaik[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[0][4]);</script></td>
                   </tr>
                 </tbody>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3>SEDANG</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>pPM10</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBaik[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[0]." - ".$dataFiturBaik[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBaik[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[1][0]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pSO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[1]." - ".$dataFiturSedang[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[1][1]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pCO</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[2]." - ".$dataFiturSedang[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[1][2]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pO3</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[3]." - ".$dataFiturSedang[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[1][3]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pNO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSedang[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[4]." - ".$dataFiturSedang[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSedang[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[1][4]);</script></td>
                   </tr>
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

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3>TIDAK SEHAT</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>pPM10</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[0]." - ".$dataFiturTSehat[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[2][0]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pSO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[1]." - ".$dataFiturTSehat[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[2][1]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pCO</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[2]." - ".$dataFiturTSehat[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[2][2]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pO3</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[3]." - ".$dataFiturTSehat[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[2][3]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pNO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturTSehat[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[4]." - ".$dataFiturTSehat[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturTSehat[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[2][4]);</script></td>
                   </tr>
                 </tbody>
               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3>SANGAT TIDAK SEHAT</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>pPM10</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[0]." - ".$dataFiturSTSehat[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[3][0]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pSO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[1]." - ".$dataFiturSTSehat[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[3][1]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pCO</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[2]." - ".$dataFiturSTSehat[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[3][2]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pO3</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[3]." - ".$dataFiturSTSehat[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[3][3]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pNO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturSTSehat[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[4]." - ".$dataFiturSTSehat[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturSTSehat[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[3][4]);</script></td>
                   </tr>
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
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3>BERBAHAYA</h3>
               <hr>
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>pPM10</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBerbahaya[5]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[0]." - ".$dataFiturBerbahaya[0]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBerbahaya[5]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[4][0]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pSO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBerbahaya[6]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[1]." - ".$dataFiturBerbahaya[1]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBerbahaya[6]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[4][1]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pCO</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBerbahaya[7]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[2]." - ".$dataFiturBerbahaya[2]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBerbahaya[7]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[4][2]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pO3</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBerbahaya[8]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[3]." - ".$dataFiturBerbahaya[3]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBerbahaya[8]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[4][3]);</script></td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>pNO2</td>
                     <td>=</td>
                     <td><p>
                       <sup>1</sup>&frasl;<sub>&radic; <span style="text-decoration:overline;">2 &pi; x <?php echo $dataFiturBerbahaya[9]; ?></span> </sub>
                       x e <sup><sup>-(<?php echo $dataTes[4]." - ".$dataFiturBerbahaya[4]; ?> )<sup>2</sup> </sup>&frasl;<sub>2 x <?php echo $dataFiturBerbahaya[9]; ?></sub></sup>
                     </p></td>
                     <td>=</td>
                     <td><script>document.write(probability[4][4]);</script></td>
                   </tr>
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
           <div class="border-bottom d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>2. Perhitungan Likelihood</b></h3>
           </div>

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-12 col-sm-12 text-center">
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>Likelihood Baik</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       <script>document.write(" = "+probability[0][0]+" X "+probability[0][1]+" X "+probability[0][2]+" X "+probability[0][3]+" X "+probability[0][4]+" X "+probability[0][5]+" = "+likelihood[0]);</script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Likelihood Sedang</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       <script>document.write(" = "+probability[1][0]+" X "+probability[1][1]+" X "+probability[1][2]+" X "+probability[1][3]+" X "+probability[1][4]+" X "+probability[1][5]+" = "+likelihood[1]);</script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Likelihood Tidak Sehat</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       <script>document.write(" = "+probability[2][0]+" X "+probability[2][1]+" X "+probability[2][2]+" X "+probability[2][3]+" X "+probability[2][4]+" X "+probability[2][5]+" = "+likelihood[2]);</script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Likelihood Sangat Tidak Sehat</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       <script>document.write(" = "+probability[3][0]+" X "+probability[3][1]+" X "+probability[3][2]+" X "+probability[3][3]+" X "+probability[3][4]+" X "+probability[3][5]+" = "+likelihood[3]);</script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Likelihood Berbahaya</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       <script>document.write(" = "+probability[4][0]+" X "+probability[4][1]+" X "+probability[4][2]+" X "+probability[4][3]+" X "+probability[4][4]+" X "+probability[4][5]+" = "+likelihood[4]);</script>
                     </td>
                   </tr>
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
           <div class="border-bottom d-flex justify-content-left align-items-center">
             <h3 style="color:white;"><b>3. Perhitungan Probabilitas Akhir</b></h3>
           </div>

           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-12 col-sm-12 text-center">
               <table class="table table-responsive table-borderless table-striped">
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                   <tr class="d-flex align-items-center">
                     <td>Probabilitas Baik</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       = <script> document.write(likelihood[0]+" / "+likelihood[0]+"+"+likelihood[1]+"+"+likelihood[2]+"+"+likelihood[3]+"+"+likelihood[4]+" = "+probAkhir[0]); </script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Probabilitas Sedang</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       = <script> document.write(likelihood[1]+" / "+likelihood[0]+"+"+likelihood[1]+"+"+likelihood[2]+"+"+likelihood[3]+"+"+likelihood[4]+" = "+probAkhir[1]); </script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Probabilitas Tidak Sehat</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       = <script> document.write(likelihood[2]+" / "+likelihood[0]+"+"+likelihood[1]+"+"+likelihood[2]+"+"+likelihood[3]+"+"+likelihood[4]+" = "+probAkhir[2]); </script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Probabilitas Sangat Tidak Sehat</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       = <script> document.write(likelihood[3]+" / "+likelihood[0]+"+"+likelihood[1]+"+"+likelihood[2]+"+"+likelihood[3]+"+"+likelihood[4]+" = "+probAkhir[3]); </script>
                     </td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>Probabilitas Berbahaya</td>
                   </tr>
                   <tr class="d-flex align-items-center">
                     <td>
                       = <script> document.write(likelihood[4]+" / "+likelihood[0]+"+"+likelihood[1]+"+"+likelihood[2]+"+"+likelihood[3]+"+"+likelihood[4]+" = "+probAkhir[4]); </script>
                     </td>
                   </tr>
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
