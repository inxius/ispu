<?php
  include_once 'session.php';
  $dataLatihEnc = json_encode($dataLatih);
  $dataTesEnc = json_encode($dataTes);
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KNN - Pengujian 1 Data</title>
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
    var dataTes = JSON.parse('<?= $dataTesEnc; ?>');
    var dataLatih = JSON.parse('<?= $dataLatihEnc; ?>');
    // var jarak_Eucli = k_getJarakEuclidian(dataLatih, dataTes);
    var jarak_Manhattan = k_getJarakManhattan(dataLatih, dataTes);
    // var jarak_Minkowski = k_getJarakMinkowski(dataLatih, dataTes);
    // var smallJarak_Eucli = k_getSmallJarak(jarak_Eucli, dataLatih, 'eucli');
    var smallJarak_Manhattan = k_getSmallJarak(jarak_Manhattan, dataLatih, 'manhattan');
    // var smallJarak_Minkowski = k_getSmallJarak(jarak_Minkowski, dataLatih, 'eucli');
    // var kat_Eucli = k_getKatKnn(smallJarak_Eucli);
    var kat_Manhattan = k_getKatKnn(smallJarak_Manhattan);
    // var kat_Minkowski = k_getKatKnn(smallJarak_Minkowski);

    var kat_baik = ["Tidak ada efek kesehatan pada manusia", "Sedikit berbau", "Luka pada beberapa spesies tumbuhan"];
    var kat_sedang = ["Perubahan kimia pada darah namun tidak terdeteksi", "Berbau", "Luka pada Babarapa spesies tumbuhan", "Terjadi penurunan pada jarak pandang"];
    var kat_TSehat = ["Peningkatan pada kardiovaskular pada perokok yang sakit jantung", "Berbau", "Peningkatan reaktivitas pembuluh tenggorokan pada penderita asma", "Penurunan kemampuan pada atlit yang berlatih keras", "Meningkatnya kerusakan tanaman", "Jarak pandang turun dan terjadi pengotoran debu di mana-mana"];
    var kat_STSehat = ["Maningkatnya kardiovaskular pada orang bukan perokok yang berpanyakit Jantung, dan akan tampak beberapa kalemahan yang terlihat secara nyata", "Meningkatnya sensitivitas pasien yang berpenyaklt asma dan bronhitis", "Olah raga ringan mangakibatkan pengaruh parnafasan pada pasien yang berpenyaklt paru-paru kronis"];

    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
      <?php
      include 'navbar.php';
      ?>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-dark">
      <div class="jumbotron-background">
        <img src="../../assets/img/color1.jpg" class="blur ">
      </div>

      <div class="container content">
        <div class="border-bottom d-flex justify-content-center align-items-center">
          <h1>Hasil Pengujian 1 Data Dengan Metode KNN</h1>
        </div>
        <br><br>
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-6 col-sm-6 text-center">
            <h1><script>document.write("Klasifikasi = "+kat_Manhattan);</script></h1>
            <br>
            <table class="table table-borderless d-flex justify-content-center align-items-center">
              <tr>
                <td>Index PM10 = <?php echo $dataTes[0]; ?></td>
                <td> Index SO2 = <?php echo $dataTes[1]; ?></td>
                <td> Index CO = <?php echo $dataTes[2]; ?></td>
              </tr>
              <tr>
                <td> Index O3 = <?php echo $dataTes[3]; ?></td>
                <td> Index NO2 = <?php echo $dataTes[4]; ?></td>
              </tr>
            </table>
            <br>
            <button class="showButton show btn btn-primary btn-full" name="tampil">Tampilkan Perhitungan</button>
            <button class="hideButton hidden btn btn-primary btn-full" name="hide">Sembunyikan Perhitungan</button>
          </div>
          <div class="col-md-6 col-sm-6">
            <h3 class="text-center">Pengaruh Tingkat Pencemaran Udara</h3>
            <hr>
            <div class="text-left">
              <ul>
                <script type="text/javascript">
                if (kat_Manhattan == "baik") {
                  for (var i = 0; i < kat_baik.length; i++) {
                    document.write('<li>'+kat_baik[i]+'</li>');
                  }
                }
                if (kat_Manhattan == "sedang") {
                  for (var i = 0; i < kat_sedang.length; i++) {
                    document.write('<li>'+kat_sedang[i]+'</li>');
                  }
                }
                if (kat_Manhattan == "tidak sehat") {
                  for (var i = 0; i < kat_TSehat.length; i++) {
                    document.write('<li>'+kat_TSehat[i]+'</li>');
                  }
                }
                if (kat_Manhattan == "sangat tidak sehat") {
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
            <h1>Perhitungan KNN</h1>
          </div>

          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>1. Perhitungan Jarak</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped">
                <tbody class="table-wrapper-scroll-y my-custom-scrollbar">
                  <?php
                  for ($i=0; $i < count($dataLatih); $i++) {
                    ?>
                    <tr class="d-flex align-items-center">
                      <td><?php echo "DT".($i+1) ?></td>
                      <td>
                        |<?php echo $dataTes[0]." - ".$dataLatih[$i][2] ?>| +
                        |<?php echo $dataTes[1]." - ".$dataLatih[$i][3] ?>| +
                        |<?php echo $dataTes[2]." - ".$dataLatih[$i][4] ?>| +
                        |<?php echo $dataTes[3]." - ".$dataLatih[$i][5] ?>| +
                        |<?php echo $dataTes[4]." - ".$dataLatih[$i][6] ?>|
                      </td>
                      <td> = </td>
                      <td><script>document.write(jarak_Manhattan[<?php echo $i; ?>]);</script></td>
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

      <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="jumbotron-background">
          <img src="../../assets/img/color1.jpg" class="blur ">
        </div>

        <div class="container content-small">
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>2. Ambil Jarak Terkecil dengan Jumlah Sesuai K</h3>
          </div>

          <div class="row d-flex justify-content-left">
            <div class="col-md-12 col-sm-12">
              <table class="table table-responsive table-borderless table-striped d-flex justify-content-left">
                <tr>
                  <th>ID</th>
                  <th>PM10</th>
                  <th>SO2</th>
                  <th>CO</th>
                  <th>O3</th>
                  <th>NO2</th>
                  <th>Kategori</th>
                  <th>Jarak</th>
                </tr>

                <script type="text/javascript">
                for (var i = 0; i < dataLatih.length; i++) {
                  for (var j = 0; j < smallJarak_Manhattan.length; j++) {
                    if (i == smallJarak_Manhattan[j][0]) {
                      document.write('<tr>');
                      document.write('<td>DT'+(i + 1)+'</td>');
                      document.write('<td>'+dataLatih[i][2]+'</td>');
                      document.write('<td>'+dataLatih[i][3]+'</td>');
                      document.write('<td>'+dataLatih[i][4]+'</td>');
                      document.write('<td>'+dataLatih[i][5]+'</td>');
                      document.write('<td>'+dataLatih[i][6]+'</td>');
                      document.write('<td>'+dataLatih[i][7]+'</td>');
                      document.write('<td>'+smallJarak_Manhattan[j][1]+'</td>');
                      document.write('</tr>');
                    }
                  }
                }
                </script>

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
