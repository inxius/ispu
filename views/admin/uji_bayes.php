<?php
  include_once 'session.php';
  $dataFiturEnc = json_encode($dataFitur);
  $dataUjiEnc = json_encode($dataUji);
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
     console.log(fitur);
     console.log(probFitur);
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
             <div class="col-md-4 col-sm-4 text-center">
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

             <div class="col-md-4 col-sm-4 text-center border-left">
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
           <div class="border-bottom d-flex justify-content-center align-items-center">
             <h3 style="color:white;"><b>1. Perhitungan Probabilitas Setiap Fitur</b></h3>
           </div>
           <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 col-sm-6 text-center">
               <h3 style="color:white;">p(PM10 | BAIK)</h3>
               <hr>
               <table id="tbpm10_baik" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(PM10 | SEDANG)</h3>
               <hr>
               <table id="tbpm10_sedang" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbpm10_tsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(PM10 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table id="tbpm10_stsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <h3 style="color:white;">p(PM10 | BERBAHAYA)</h3>
               <hr>
               <table id="tbpm10_berbahaya" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbso2_baik" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(SO2 | SEDANG)</h3>
               <hr>
               <table id="tbso2_sedang" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbso2_tsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(SO2 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table id="tbso2_stsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <h3 style="color:white;">p(SO2 | BERBAHAYA)</h3>
               <hr>
               <table id="tbso2_berbahaya" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbco_baik" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(CO | SEDANG)</h3>
               <hr>
               <table id="tbco_sedang" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbco_tsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(CO | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table id="tbco_stsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <h3 style="color:white;">p(CO | BERBAHAYA)</h3>
               <hr>
               <table id="tbco_berbahaya" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbo3_baik" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(O3 | SEDANG)</h3>
               <hr>
               <table id="tbo3_sedang" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbo3_tsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(O3 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table id="tbo3_stsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <h3 style="color:white;">p(O3 | BERBAHAYA)</h3>
               <hr>
               <table id="tbo3_berbahaya" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbno2_baik" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(NO2 | SEDANG)</h3>
               <hr>
               <table id="tbno2_sedang" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tbno2_tsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

               </table>
             </div>

             <div class="col-md-6 col-sm-6 text-center border-left">
               <h3 style="color:white;">p(NO2 | SANGAT TIDAK SEHAT)</h3>
               <hr>
               <table id="tbno2_stsehat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <h3 style="color:white;">p(NO2 | BERBAHAYA)</h3>
               <hr>
               <table id="tbno2_berbahaya" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tb_likelihood" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tb_propak" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
               <table id="tb_klas" class="table table-responsive table-borderless table-striped">
                 <thead>
                   <tr>
                     <td>Data</td>
                     <td>Terget Klasifikasi</td>
                     <td>Hasil Klasifikasi</td>
                     <td>Benar / Salah</td>
                   </tr>
                 </thead>
                 <tbody class="table-wrapper-scroll-y my-custom-scrollbar">

                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>


     </div>

     <script type="text/javascript">

     function cucu(i, datauji, fiturmean, fiturs2, hasil){
       var coco = '<tr class="d-flex align-items-center">'
          +'<td>DT '+(i + 1)+'</td>'
          +'<td><p><sup>1</sup>&frasl;<sub>&radic; '
          +'<span style="text-decoration:overline;">2 &pi; x '
          +fiturs2+'</span></sub>'
          +'x e <sup><sup>-('+datauji+' - '+fiturmean+')<sup>2</sup>'
          +'</sup>&frasl;<sub>2 x '+fiturs2+'</sub></sup>'
          +'</p></td><td> = </td>'
          +'<td>'+hasil+'</td></tr>';

        return coco;
     }

       $(function(){
         $('.showButton').click(function(){
           $('.hidden').show();
           $('.show').hide();
         });

         $('.hideButton').click(function(){
           $('.hidden').hide();
           $('.show').show();
         });

         $(document).ready(function(){
           for (var i = 0; i < 10; i++) {
             var pm10_baik = cucu(i, dataUji[i][2], fitur[0][0], fitur[0][5], probFitur[i][0][0]);
             $('#tbpm10_baik').append(pm10_baik);

             var pm10_sedang = cucu(i, dataUji[i][2], fitur[1][0], fitur[1][5], probFitur[i][1][0]);
             $('#tbpm10_sedang').append(pm10_sedang);

             var pm10_tsehat = cucu(i, dataUji[i][2], fitur[2][0], fitur[2][5], probFitur[i][2][0])
             $('#tbpm10_tsehat').append(pm10_tsehat);

             var pm10_stsehat = cucu(i, dataUji[i][2], fitur[3][0], fitur[3][5], probFitur[i][3][0])
             $('#tbpm10_stsehat').append(pm10_stsehat);

             var pm10_berbahaya = cucu(i, dataUji[i][2], fitur[4][0], fitur[4][5], probFitur[i][4][0])
             $('#tbpm10_berbahaya').append(pm10_berbahaya);

             var so2_baik = cucu(i, dataUji[i][3], fitur[0][1], fitur[0][6], probFitur[i][0][1]);
             $('#tbso2_baik').append(so2_baik);

             var so2_sedang = cucu(i, dataUji[i][3], fitur[1][1], fitur[1][6], probFitur[i][1][1]);
             $('#tbso2_sedang').append(so2_sedang);

             var so2_tsehat = cucu(i, dataUji[i][3], fitur[2][1], fitur[2][6], probFitur[i][2][1]);
             $('#tbso2_tsehat').append(so2_tsehat);

             var so2_stsehat = cucu(i, dataUji[i][3], fitur[3][1], fitur[3][6], probFitur[i][3][1]);
             $('#tbso2_stsehat').append(so2_stsehat);

             var so2_berbahaya = cucu(i, dataUji[i][3], fitur[4][1], fitur[4][6], probFitur[i][4][1]);
             $('#tbso2_berbahaya').append(so2_berbahaya);

             var co_baik = cucu(i, dataUji[i][4], fitur[0][2], fitur[0][7], probFitur[i][0][2]);
             $('#tbco_baik').append(co_baik);

             var co_sedang = cucu(i, dataUji[i][4], fitur[1][2], fitur[1][7], probFitur[i][1][2]);
             $('#tbco_sedang').append(co_sedang);

             var co_tsehat = cucu(i, dataUji[i][4], fitur[2][2], fitur[2][7], probFitur[i][2][2]);
             $('#tbco_tsehat').append(co_tsehat);

             var co_stsehat = cucu(i, dataUji[i][4], fitur[3][2], fitur[3][7], probFitur[i][3][2]);
             $('#tbco_stsehat').append(co_stsehat);

             var co_berbahaya = cucu(i, dataUji[i][4], fitur[4][2], fitur[4][7], probFitur[i][4][2]);
             $('#tbco_berbahaya').append(co_berbahaya);

             var o3_baik = cucu(i, dataUji[i][5], fitur[0][3], fitur[0][8], probFitur[i][0][3]);
             $('#tbo3_baik').append(o3_baik);

             var o3_sedang = cucu(i, dataUji[i][5], fitur[1][3], fitur[1][8], probFitur[i][1][3]);
             $('#tbo3_sedang').append(o3_sedang);

             var o3_tsehat = cucu(i, dataUji[i][5], fitur[2][3], fitur[2][8], probFitur[i][2][3]);
             $('#tbo3_tsehat').append(o3_tsehat);

             var o3_stsehat = cucu(i, dataUji[i][5], fitur[3][3], fitur[3][8], probFitur[i][3][3]);
             $('#tbo3_stsehat').append(o3_stsehat);

             var o3_berbahaya = cucu(i, dataUji[i][5], fitur[4][3], fitur[4][8], probFitur[i][4][3]);
             $('#tbo3_berbahaya').append(o3_berbahaya);

             var no2_baik = cucu(i, dataUji[i][6], fitur[0][4], fitur[0][9], probFitur[i][0][4]);
             $('#tbno2_baik').append(no2_baik);

             var no2_sedang = cucu(i, dataUji[i][6], fitur[1][4], fitur[1][9], probFitur[i][1][4]);
             $('#tbno2_sedang').append(no2_sedang);

             var no2_tsehat = cucu(i, dataUji[i][6], fitur[2][4], fitur[2][9], probFitur[i][2][4]);
             $('#tbno2_tsehat').append(no2_tsehat);

             var no2_stsehat = cucu(i, dataUji[i][6], fitur[3][4], fitur[3][9], probFitur[i][3][4]);
             $('#tbno2_stsehat').append(no2_stsehat);

             var no2_berbahaya = cucu(i, dataUji[i][6], fitur[4][4], fitur[4][9], probFitur[i][4][4]);
             $('#tbno2_berbahaya').append(no2_berbahaya);
           }

           for (var i = 0; i < 10; i++) {
             var cici = '<tr><td colspan="4" class="text-center">DT '
             +(i + 1)+'</td></tr>';
             $('#tb_likelihood').append(cici);
             for (var j = 0; j < 5; j++) {
               if (j == 0) {
                 var minicoco = '<td>Baik</td>';
               }
               else if (j == 1) {
                 var minicoco = '<td>Sedang</td>';
               }
               else if (j == 2) {
                 var minicoco = '<td>Tidak Sehat</td>';
               }
               else if (j == 3) {
                 var minicoco = '<td>Sangat Tidak Sehat</td>';
               }
               else if (j == 4) {
                 var minicoco = '<td>Berbahaya</td>';
               }

               var coco = '<tr>'+minicoco+'<td>'
               +probFitur[i][j][0]+' X '+probFitur[i][j][1]+' X '
               +probFitur[i][j][2]+' X '+probFitur[i][j][3]+' X '
               +probFitur[i][j][4]+' X '+probFitur[i][j][5]+'</td>'
               +'<td> = </td><td>'+likelihood[i][j]+'</td></tr>';
               $('#tb_likelihood').append(coco);
             }
           }

           for (var i = 0; i < 10; i++) {
             var cici = '<tr><td colspan="4" class="text-center">DT '
             +(i + 1)+'</td></tr>';
             $('#tb_propak').append(cici);
             for (var j = 0; j < 5; j++) {
               if (j == 0) {
                 var minicoco = '<td>Baik</td>';
               }
               else if (j == 1) {
                 var minicoco = '<td>Sedang</td>';
               }
               else if (j == 2) {
                 var minicoco = '<td>Tidak Sehat</td>';
               }
               else if (j == 3) {
                 var minicoco = '<td>Sangat Tidak Sehat</td>';
               }
               else if (j == 4) {
                 var minicoco = '<td>Berbahaya</td>';
               }

               var coco = '<tr class="text-left">'+minicoco+'<td><h5> = '
               +'<sup>'+likelihood[i][j]+'</sup>&frasl;<sub>'+likelihood[i][0]+' + '
               +likelihood[0][1]+' + '+likelihood[0][2]+' + '
               +likelihood[0][3]+' + '+likelihood[0][4]+'</sub></h5></td>'
               +'<td> = </td><td>'+probAkhir[i][j]+'</td></tr>';
               $('#tb_propak').append(coco);
             }
           }

           for (var i = 0; i < 15; i++) {
             var coco = '<tr><td>DT '+(i + 1)+'<td>'
             +'<td>'+dataUji[i][7]+'</td>'
             +'<td>'+KatBayes[i][0]+'</td>'
             +'<td>'+KatBayes[i][1]+'</td></tr>';
             $('#tb_klas tbody').append(coco);
           }
         });

         $('#tbpm10_baik').scroll(function(){
           if ($('#tbpm10_baik').scrollTop() == $('#tbpm10_baik').prop('scrollHeight') - $('#tbpm10_baik').prop('offsetHeight')) {
             var isi = $('#tbpm10_baik tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][2], fitur[0][0], fitur[0][5], probFitur[j][0][0]);
               $('#tbpm10_baik').append(coco);
             }
           }
         });

         $('#tbpm10_sedang').scroll(function(){
           if ($('#tbpm10_sedang').scrollTop() == $('#tbpm10_sedang').prop('scrollHeight') - $('#tbpm10_sedang').prop('offsetHeight')) {
             var isi = $('#tbpm10_sedang tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][2], fitur[1][0], fitur[1][5], probFitur[j][1][0]);
               $('#tbpm10_sedang').append(coco);
             }
           }
         });

         $('#tbpm10_tsehat').scroll(function(){
           if ($('#tbpm10_tsehat').scrollTop() == $('#tbpm10_tsehat').prop('scrollHeight') - $('#tbpm10_tsehat').prop('offsetHeight')) {
             var isi = $('#tbpm10_tsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][2], fitur[2][0], fitur[2][5], probFitur[j][2][0]);
               $('#tbpm10_tsehat').append(coco);
             }
           }
         });

         $('#tbpm10_stsehat').scroll(function(){
           if ($('#tbpm10_stsehat').scrollTop() == $('#tbpm10_stsehat').prop('scrollHeight') - $('#tbpm10_stsehat').prop('offsetHeight')) {
             var isi = $('#tbpm10_stsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][2], fitur[3][0], fitur[3][5], probFitur[j][3][0]);
               $('#tbpm10_stsehat').append(coco);
             }
           }
         });

         $('#tbpm10_berbahaya').scroll(function(){
           if ($('#tbpm10_berbahaya').scrollTop() == $('#tbpm10_berbahaya').prop('scrollHeight') - $('#tbpm10_berbahaya').prop('offsetHeight')) {
             var isi = $('#tbpm10_berbahaya tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][2], fitur[4][0], fitur[4][5], probFitur[j][4][0]);
               $('#tbpm10_berbahaya').append(coco);
             }
           }
         });

         $('#tbso2_baik').scroll(function(){
           if ($('#tbso2_baik').scrollTop() == $('#tbso2_baik').prop('scrollHeight') - $('#tbso2_baik').prop('offsetHeight')) {
             var isi = $('#tbso2_baik tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][3], fitur[0][1], fitur[0][6], probFitur[j][0][1]);
               $('#tbso2_baik').append(coco);
             }
           }
         });

         $('#tbso2_sedang').scroll(function(){
           if ($('#tbso2_sedang').scrollTop() == $('#tbso2_sedang').prop('scrollHeight') - $('#tbso2_sedang').prop('offsetHeight')) {
             var isi = $('#tbso2_sedang tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][3], fitur[1][1], fitur[1][6], probFitur[j][1][1]);
               $('#tbso2_sedang').append(coco);
             }
           }
         });

         $('#tbso2_tsehat').scroll(function(){
           if ($('#tbso2_tsehat').scrollTop() == $('#tbso2_tsehat').prop('scrollHeight') - $('#tbso2_tsehat').prop('offsetHeight')) {
             var isi = $('#tbso2_tsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][3], fitur[2][1], fitur[2][6], probFitur[j][2][1]);
               $('#tbso2_tsehat').append(coco);
             }
           }
         });

         $('#tbso2_stsehat').scroll(function(){
           if ($('#tbso2_stsehat').scrollTop() == $('#tbso2_stsehat').prop('scrollHeight') - $('#tbso2_stsehat').prop('offsetHeight')) {
             var isi = $('#tbso2_stsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][3], fitur[3][1], fitur[3][6], probFitur[j][3][1]);
               $('#tbso2_stsehat').append(coco);
             }
           }
         });

         $('#tbso2_berbahaya').scroll(function(){
           if ($('#tbso2_berbahaya').scrollTop() == $('#tbso2_berbahaya').prop('scrollHeight') - $('#tbso2_berbahaya').prop('offsetHeight')) {
             var isi = $('#tbso2_berbahaya tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][3], fitur[4][1], fitur[4][6], probFitur[j][4][1]);
               $('#tbso2_berbahaya').append(coco);
             }
           }
         });

         $('#tbco_baik').scroll(function(){
           if ($('#tbco_baik').scrollTop() == $('#tbco_baik').prop('scrollHeight') - $('#tbco_baik').prop('offsetHeight')) {
             var isi = $('#tbco_baik tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][4], fitur[0][2], fitur[0][7], probFitur[j][0][2]);
               $('#tbco_baik').append(coco);
             }
           }
         });

         $('#tbco_sedang').scroll(function(){
           if ($('#tbco_sedang').scrollTop() == $('#tbco_sedang').prop('scrollHeight') - $('#tbco_sedang').prop('offsetHeight')) {
             var isi = $('#tbco_sedang tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][4], fitur[1][2], fitur[1][7], probFitur[j][1][2]);
               $('#tbco_sedang').append(coco);
             }
           }
         });

         $('#tbco_tsehat').scroll(function(){
           if ($('#tbco_tsehat').scrollTop() == $('#tbco_tsehat').prop('scrollHeight') - $('#tbco_tsehat').prop('offsetHeight')) {
             var isi = $('#tbco_tsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][4], fitur[2][2], fitur[2][7], probFitur[j][2][2]);
               $('#tbco_tsehat').append(coco);
             }
           }
         });

         $('#tbco_stsehat').scroll(function(){
           if ($('#tbco_stsehat').scrollTop() == $('#tbco_stsehat').prop('scrollHeight') - $('#tbco_stsehat').prop('offsetHeight')) {
             var isi = $('#tbco_stsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][4], fitur[3][2], fitur[3][7], probFitur[j][3][2]);
               $('#tbco_stsehat').append(coco);
             }
           }
         });

         $('#tbco_berbahaya').scroll(function(){
           if ($('#tbco_berbahaya').scrollTop() == $('#tbco_berbahaya').prop('scrollHeight') - $('#tbco_berbahaya').prop('offsetHeight')) {
             var isi = $('#tbco_berbahaya tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][4], fitur[4][2], fitur[4][7], probFitur[j][4][2]);
               $('#tbco_berbahaya').append(coco);
             }
           }
         });

         $('#tbo3_baik').scroll(function(){
           if ($('#tbo3_baik').scrollTop() == $('#tbo3_baik').prop('scrollHeight') - $('#tbo3_baik').prop('offsetHeight')) {
             var isi = $('#tbo3_baik tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][5], fitur[0][3], fitur[0][8], probFitur[j][0][3]);
               $('#tbo3_baik').append(coco);
             }
           }
         });

         $('#tbo3_sedang').scroll(function(){
           if ($('#tbo3_sedang').scrollTop() == $('#tbo3_sedang').prop('scrollHeight') - $('#tbo3_sedang').prop('offsetHeight')) {
             var isi = $('#tbo3_sedang tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][5], fitur[1][3], fitur[1][8], probFitur[j][1][3]);
               $('#tbo3_sedang').append(coco);
             }
           }
         });

         $('#tbo3_tsehat').scroll(function(){
           if ($('#tbo3_tsehat').scrollTop() == $('#tbo3_tsehat').prop('scrollHeight') - $('#tbo3_tsehat').prop('offsetHeight')) {
             var isi = $('#tbo3_tsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][5], fitur[2][3], fitur[2][8], probFitur[j][2][3]);
               $('#tbo3_tsehat').append(coco);
             }
           }
         });

         $('#tbo3_stsehat').scroll(function(){
           if ($('#tbo3_stsehat').scrollTop() == $('#tbo3_stsehat').prop('scrollHeight') - $('#tbo3_stsehat').prop('offsetHeight')) {
             var isi = $('#tbo3_stsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][5], fitur[3][3], fitur[3][8], probFitur[j][3][3]);
               $('#tbo3_stsehat').append(coco);
             }
           }
         });

         $('#tbo3_berbahaya').scroll(function(){
           if ($('#tbo3_berbahaya').scrollTop() == $('#tbo3_berbahaya').prop('scrollHeight') - $('#tbo3_berbahaya').prop('offsetHeight')) {
             var isi = $('#tbo3_berbahaya tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][5], fitur[4][3], fitur[4][8], probFitur[j][4][3]);
               $('#tbo3_berbahaya').append(coco);
             }
           }
         });

         $('#tbno2_baik').scroll(function(){
           if ($('#tbno2_baik').scrollTop() == $('#tbno2_baik').prop('scrollHeight') - $('#tbno2_baik').prop('offsetHeight')) {
             var isi = $('#tbno2_baik tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][6], fitur[0][4], fitur[0][9], probFitur[j][0][4]);
               $('#tbno2_baik').append(coco);
             }
           }
         });

         $('#tbno2_sedang').scroll(function(){
           if ($('#tbno2_sedang').scrollTop() == $('#tbno2_sedang').prop('scrollHeight') - $('#tbno2_sedang').prop('offsetHeight')) {
             var isi = $('#tbno2_sedang tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][6], fitur[1][4], fitur[1][9], probFitur[j][1][4]);
               $('#tbno2_sedang').append(coco);
             }
           }
         });

         $('#tbno2_tsehat').scroll(function(){
           if ($('#tbno2_tsehat').scrollTop() == $('#tbno2_tsehat').prop('scrollHeight') - $('#tbno2_tsehat').prop('offsetHeight')) {
             var isi = $('#tbno2_tsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][6], fitur[2][4], fitur[2][9], probFitur[j][2][4]);
               $('#tbno2_tsehat').append(coco);
             }
           }
         });

         $('#tbno2_stsehat').scroll(function(){
           if ($('#tbno2_stsehat').scrollTop() == $('#tbno2_stsehat').prop('scrollHeight') - $('#tbno2_stsehat').prop('offsetHeight')) {
             var isi = $('#tbno2_stsehat tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][6], fitur[3][4], fitur[3][9], probFitur[j][3][4]);
               $('#tbno2_stsehat').append(coco);
             }
           }
         });

         $('#tbno2_berbahaya').scroll(function(){
           if ($('#tbno2_berbahaya').scrollTop() == $('#tbno2_berbahaya').prop('scrollHeight') - $('#tbno2_berbahaya').prop('offsetHeight')) {
             var isi = $('#tbno2_berbahaya tr').length;
             for (var i = 0; i < 10; i++) {
               var j = isi + i;
               var coco = cucu(j, dataUji[j][6], fitur[4][4], fitur[4][9], probFitur[j][4][4]);
               $('#tbno2_berbahaya').append(coco);
             }
           }
         });

         $('#tb_likelihood').scroll(function(){
           if ($('#tb_likelihood').scrollTop() == $('#tb_likelihood').prop('scrollHeight') - $('#tb_likelihood').prop('offsetHeight')) {
             var isi = $('#tb_likelihood tr').length / 6;
             for (var k = 0; k < 10; k++) {
               var i = isi + k;
               var cici = '<tr><td colspan="4" class="text-center">DT '
               +(i + 1)+'</td></tr>';
               $('#tb_likelihood').append(cici);
               for (var j = 0; j < 5; j++) {
                 if (j == 0) {
                   var minicoco = '<td>Baik</td>';
                 }
                 else if (j == 1) {
                   var minicoco = '<td>Sedang</td>';
                 }
                 else if (j == 2) {
                   var minicoco = '<td>Tidak Sehat</td>';
                 }
                 else if (j == 3) {
                   var minicoco = '<td>Sangat Tidak Sehat</td>';
                 }
                 else if (j == 4) {
                   var minicoco = '<td>Berbahaya</td>';
                 }

                 var coco = '<tr>'+minicoco+'<td>'
                 +probFitur[i][j][0]+' X '+probFitur[i][j][1]+' X '
                 +probFitur[i][j][2]+' X '+probFitur[i][j][3]+' X '
                 +probFitur[i][j][4]+' X '+probFitur[i][j][5]+'</td>'
                 +'<td> = </td><td>'+likelihood[i][j]+'</td></tr>';
                 $('#tb_likelihood').append(coco);
               }
             }
           }
         });

         $('#tb_propak').scroll(function(){
           if ($('#tb_propak').scrollTop() == $('#tb_propak').prop('scrollHeight') - $('#tb_propak').prop('offsetHeight')) {
             var isi = $('#tb_propak tr').length / 6;
             for (var k = 0; k < 10; k++) {
               var i = isi + k;
               var cici = '<tr><td colspan="4" class="text-center">DT '
               +(i + 1)+'</td></tr>';
               $('#tb_propak').append(cici);
               for (var j = 0; j < 5; j++) {
                 if (j == 0) {
                   var minicoco = '<td>Baik</td>';
                 }
                 else if (j == 1) {
                   var minicoco = '<td>Sedang</td>';
                 }
                 else if (j == 2) {
                   var minicoco = '<td>Tidak Sehat</td>';
                 }
                 else if (j == 3) {
                   var minicoco = '<td>Sangat Tidak Sehat</td>';
                 }
                 else if (j == 4) {
                   var minicoco = '<td>Berbahaya</td>';
                 }

                 var coco = '<tr class="text-left">'+minicoco+'<td><h5> = '
                 +'<sup>'+likelihood[i][j]+'</sup>&frasl;<sub>'+likelihood[i][0]+' + '
                 +likelihood[0][1]+' + '+likelihood[0][2]+' + '
                 +likelihood[0][3]+' + '+likelihood[0][4]+'</sub></h5></td>'
                 +'<td> = </td><td>'+probAkhir[i][j]+'</td></tr>';
                 $('#tb_propak').append(coco);
               }
             }
           }
         });

         $('#tb_klas tbody').scroll(function(){
           if ($('#tb_klas tbody').scrollTop() == $('#tb_klas tbody').prop('scrollHeight') - $('#tb_klas tbody').prop('offsetHeight')) {
             var isi = $('#tb_klas tbody tr').length;
             for (var i = 0; i < 15; i++) {
               var j = isi + i;
               var coco = '<tr><td>DT '+(j + 1)+'<td>'
               +'<td>'+dataUji[j][7]+'</td>'
               +'<td>'+KatBayes[j][0]+'</td>'
               +'<td>'+KatBayes[j][1]+'</td></tr>';
               $('#tb_klas tbody').append(coco);
             }
           }
         });

       });
     </script>
   </body>
 </html>
