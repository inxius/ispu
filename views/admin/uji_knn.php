<?php
include_once 'session.php';
$dataLatihEnc = json_encode($dataLatih);
$dataUjiEnc = json_encode($dataUji);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>KNN - Pengujian Data Uji</title>
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
  var dataUji = JSON.parse('<?= $dataUjiEnc; ?>');
  var dataLatih = JSON.parse('<?= $dataLatihEnc; ?>');
  var jarak_Eucli = u_getJarakEuclidean(dataLatih, dataUji);
  var jarak_Manhattan = u_getJarakManhattan(dataLatih, dataUji);
  var jarak_Minkowski = u_getJarakMinkowski(dataLatih, dataUji);
  var smallJarak_Eucli = u_getSmallJarak(jarak_Eucli, dataLatih, 'eucli');
  var smallJarak_Manhattan = u_getSmallJarak(jarak_Manhattan, dataLatih, 'manhattan');
  var smallJarak_Minkowski = u_getSmallJarak(jarak_Minkowski, dataLatih, 'minkowski');
  var kat_Eucli = u_getKatKnn(smallJarak_Eucli, dataUji);
  var kat_Manhattan = u_getKatKnn(smallJarak_Manhattan, dataUji);
  var kat_Minkowski = u_getKatKnn(smallJarak_Minkowski, dataUji);
  var akurasi_Eucli = u_getAkurasiKnn(kat_Eucli);
  var akurasi_Manhattan = u_getAkurasiKnn(kat_Manhattan);
  var akurasi_Minkowsi = u_getAkurasiKnn(kat_Minkowski);
  console.log(akurasi_Eucli);
  console.log(akurasi_Manhattan);
  console.log(akurasi_Minkowsi);
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
        <h1>Hasil Pengujian Data Uji Dengan Metode KNN</h1>
      </div>
      <br><br>

      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 col-sm-4">
          <h5 class="text-center"><script>document.write("Akurasi Euclidean = "+akurasi_Eucli[0])</script> %</h5>
          <div class="text-left border-top">
            <ul>
              <li>Total Data Uji = <script>document.write(akurasi_Eucli[1])</script></li>
              <li>Benar = <script>document.write(akurasi_Eucli[2])</script></li>
              <li>Salah = <script>document.write(akurasi_Eucli[3])</script></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 border-left">
          <h5 class="text-center"><script>document.write("Akurasi Manhattan = "+akurasi_Manhattan[0])</script> %</h5>
          <div class="text-left border-top">
            <ul>
              <li>Total Data Uji = <script>document.write(akurasi_Manhattan[1])</script></li>
              <li>Benar = <script>document.write(akurasi_Manhattan[2])</script></li>
              <li>Salah = <script>document.write(akurasi_Manhattan[3])</script></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 border-left">
          <h5 class="text-center"><script>document.write("Akurasi Minkowski = "+akurasi_Minkowsi[0])</script> %</h5>
          <div class="text-left border-top">
            <ul>
              <li>Total Data Uji = <script>document.write(akurasi_Minkowsi[1])</script></li>
              <li>Benar = <script>document.write(akurasi_Minkowsi[2])</script></li>
              <li>Salah = <script>document.write(akurasi_Minkowsi[3])</script></li>
            </ul>
          </div>
        </div>
        <br><br><br>
        <button class="showButton show btn btn-primary btn-full" name="tampil">Tampilkan Perhitungan</button>
        <button class="hideButton hidden btn btn-primary btn-full" name="hide">Sembunyikan Perhitungan</button>
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
          <h1>Perhitungan KNN Metode Euclidean</h1>
        </div>

        <div class="border-bottom d-flex justify-content-center align-items-center">
          <h3>1. Perhitungan Jarak</h3>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-12 col-sm-12 text-center">
            <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
              <?php
              // for ($i=0; $i < count($dataUji); $i++) {
              for ($i=0; $i < 10; $i++) {
                echo "<tr>";
                echo '<td colspan="4" class="text-center">DT Uji '.($i + 1).'</td>';
                echo "</tr>";
                // for ($j=0; $j < count($dataLatih); $j++) {
                for ($j=0; $j < 5; $j++) {
                  ?>
                  <tr>
                    <td>DT Latih <?php echo $j + 1; ?></td>
                    <td><h5>
                      <sub>&radic; <span style="text-decoration:overline;">(<?php echo $dataUji[$i][2]." - ".$dataLatih[$j][2] ?>)<sup>2</sup> +
                        (<?php echo $dataUji[$i][3]." - ".$dataLatih[$j][3] ?>)<sup>2</sup> +
                        (<?php echo $dataUji[$i][4]." - ".$dataLatih[$j][4] ?>)<sup>2</sup> +
                        (<?php echo $dataUji[$i][5]." - ".$dataLatih[$j][5] ?>)<sup>2</sup> +
                        (<?php echo $dataUji[$i][6]." - ".$dataLatih[$j][6] ?>)<sup>2</sup> + </span></sub>
                      </h5></td>
                      <td> = </td>
                      <td><script>document.write(jarak_Eucli[<?php echo $i ?>][<?php echo $j ?>])</script></td>
                    </tr>
                    <?php
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
          <img src="../../assets/img/color1.jpg" class="blur">
        </div>

        <div class="container content-small">
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>2. Ambil Jarak Terkecil dengan Jumlah Sesuai K</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <?php
                // for ($i=0; $i < count($dataUji); $i++) {
                for ($i=0; $i < 10; $i++) {
                  ?>
                  <tr>
                    <td colspan="8" class="text-center">DT Uji <?php echo $i + 1; ?></td>
                  </tr>
                  <tr>
                    <td>Data Latih</td>
                    <td>PM10</td>
                    <td>SO2</td>
                    <td>CO</td>
                    <td>O3</td>
                    <td>NO2</td>
                    <td>Kategori</td>
                    <td>Jarak</td>
                  </tr>
                  <?php
                  for ($j=0; $j < 5; $j++) {
                    ?>
                    <script type="text/javascript">
                    var i = smallJarak_Eucli[<?php echo $i; ?>][<?php echo $j; ?>][0];
                    </script>
                    <tr>
                      <td>DT Latih <script>document.write(i+1)</script></td>
                      <td><script>document.write(dataLatih[i][2])</script></td>
                      <td><script>document.write(dataLatih[i][3])</script></td>
                      <td><script>document.write(dataLatih[i][4])</script></td>
                      <td><script>document.write(dataLatih[i][5])</script></td>
                      <td><script>document.write(dataLatih[i][6])</script></td>
                      <td><script>document.write(dataLatih[i][7])</script></td>
                      <td><script>document.write(smallJarak_Eucli[<?php echo $i; ?>][<?php echo $j; ?>][1])</script></td>
                    </tr>
                    <?php
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
          <img src="../../assets/img/color1.jpg" class="blur">
        </div>

        <div class="container content-small">
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>3. Pengklasifikasian</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <tr>
                  <td>Data Uji</td>
                  <td>Terget Klasifikasi</td>
                  <td>Hasil Klasifikasi</td>
                  <td>Benar / Salah</td>
                </tr>
                <?php
                // for ($i=0; $i < count($dataUji); $i++) {
                for ($i=0; $i < 10; $i++) {
                  ?>
                  <tr>
                    <td>DT Uji <?php echo $i + 1; ?></td>
                    <td><script>document.write(kat_Eucli[<?php echo $i; ?>][0])</script></td>
                    <td><script>document.write(kat_Eucli[<?php echo $i; ?>][1])</script></td>
                    <td><script>document.write(kat_Eucli[<?php echo $i; ?>][2])</script></td>
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
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h1>Perhitungan KNN Metode Manhattan</h1>
          </div>

          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>1. Perhitungan Jarak</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <?php
                // for ($i=0; $i < count($dataUji); $i++) {
                for ($i=0; $i < 10; $i++) {
                  echo "<tr>";
                  echo '<td colspan="4" class="text-center">DT Uji '.($i + 1).'</td>';
                  echo "</tr>";
                  // for ($j=0; $j < count($dataLatih); $j++) {
                  for ($j=0; $j < 5; $j++) {
                    ?>
                    <tr>
                      <td>DT Latih <?php echo $j + 1; ?></td>
                      <td>
                        |<?php echo $dataUji[$i][2]." - ".$dataLatih[$j][2] ?>| +
                        |<?php echo $dataUji[$i][3]." - ".$dataLatih[$j][3] ?>| +
                        |<?php echo $dataUji[$i][4]." - ".$dataLatih[$j][4] ?>| +
                        |<?php echo $dataUji[$i][5]." - ".$dataLatih[$j][5] ?>| +
                        |<?php echo $dataUji[$i][6]." - ".$dataLatih[$j][6] ?>|
                      </td>
                      <td> = </td>
                      <td><script>document.write(jarak_Manhattan[<?php echo $i ?>][<?php echo $j ?>])</script></td>
                      </tr>
                      <?php
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
            <img src="../../assets/img/color1.jpg" class="blur">
          </div>

          <div class="container content-small">
            <div class="border-bottom d-flex justify-content-center align-items-center">
              <h3>2. Ambil Jarak Terkecil dengan Jumlah Sesuai K</h3>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-md-12 col-sm-12 text-center">
                <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                  <?php
                  // for ($i=0; $i < count($dataUji); $i++) {
                  for ($i=0; $i < 10; $i++) {
                    ?>
                    <tr>
                      <td colspan="8" class="text-center">DT Uji <?php echo $i + 1; ?></td>
                    </tr>
                    <tr>
                      <td>Data Latih</td>
                      <td>PM10</td>
                      <td>SO2</td>
                      <td>CO</td>
                      <td>O3</td>
                      <td>NO2</td>
                      <td>Kategori</td>
                      <td>Jarak</td>
                    </tr>
                    <?php
                    for ($j=0; $j < 5; $j++) {
                      ?>
                      <script type="text/javascript">
                      var i = smallJarak_Manhattan[<?php echo $i; ?>][<?php echo $j; ?>][0];
                      </script>
                      <tr>
                        <td>DT Latih <script>document.write(i+1)</script></td>
                        <td><script>document.write(dataLatih[i][2])</script></td>
                        <td><script>document.write(dataLatih[i][3])</script></td>
                        <td><script>document.write(dataLatih[i][4])</script></td>
                        <td><script>document.write(dataLatih[i][5])</script></td>
                        <td><script>document.write(dataLatih[i][6])</script></td>
                        <td><script>document.write(dataLatih[i][7])</script></td>
                        <td><script>document.write(smallJarak_Manhattan[<?php echo $i; ?>][<?php echo $j; ?>][1])</script></td>
                      </tr>
                      <?php
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
            <img src="../../assets/img/color1.jpg" class="blur">
          </div>

          <div class="container content-small">
            <div class="border-bottom d-flex justify-content-center align-items-center">
              <h3>3. Pengklasifikasian</h3>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-md-12 col-sm-12 text-center">
                <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                  <tr>
                    <td>Data Uji</td>
                    <td>Terget Klasifikasi</td>
                    <td>Hasil Klasifikasi</td>
                    <td>Benar / Salah</td>
                  </tr>
                  <?php
                  // for ($i=0; $i < count($dataUji); $i++) {
                  for ($i=0; $i < 10; $i++) {
                    ?>
                    <tr>
                      <td>DT Uji <?php echo $i + 1; ?></td>
                      <td><script>document.write(kat_Manhattan[<?php echo $i; ?>][0])</script></td>
                      <td><script>document.write(kat_Manhattan[<?php echo $i; ?>][1])</script></td>
                      <td><script>document.write(kat_Manhattan[<?php echo $i; ?>][2])</script></td>
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
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h1>Perhitungan KNN Metode Minkowski</h1>
          </div>

          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>1. Perhitungan Jarak</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <?php
                // for ($i=0; $i < count($dataUji); $i++) {
                for ($i=0; $i < 10; $i++) {
                  echo "<tr>";
                  echo '<td colspan="4" class="text-center">DT Uji '.($i + 1).'</td>';
                  echo "</tr>";
                  // for ($j=0; $j < count($dataLatih); $j++) {
                  for ($j=0; $j < 5; $j++) {
                    ?>
                    <tr>
                      <td>DT Latih <?php echo $j + 1; ?></td>
                      <td><sub>
                        ( |<?php echo $dataUji[$i][2]." - ".$dataLatih[$j][2] ?>|<sup>3</sup> +
                        |<?php echo $dataUji[$i][3]." - ".$dataLatih[$j][3] ?>|<sup>3</sup> +
                        |<?php echo $dataUji[$i][4]." - ".$dataLatih[$j][4] ?>|<sup>3</sup> +
                        |<?php echo $dataUji[$i][5]." - ".$dataLatih[$j][5] ?>|<sup>3</sup> +
                        |<?php echo $dataUji[$i][6]." - ".$dataLatih[$j][6] ?>|<sup>3</sup> )</sub><sup>1/3</sup>
                      </td>
                      <td> = </td>
                      <td><script>document.write(jarak_Minkowski[<?php echo $i ?>][<?php echo $j ?>])</script></td>
                      </tr>
                      <?php
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
          <img src="../../assets/img/color1.jpg" class="blur">
        </div>

        <div class="container content-small">
          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>2. Ambil Jarak Terkecil dengan Jumlah Sesuai K</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <?php
                // for ($i=0; $i < count($dataUji); $i++) {
                for ($i=0; $i < 10; $i++) {
                  ?>
                  <tr>
                    <td colspan="8" class="text-center">DT Uji <?php echo $i + 1; ?></td>
                  </tr>
                  <tr>
                    <td>Data Latih</td>
                    <td>PM10</td>
                    <td>SO2</td>
                    <td>CO</td>
                    <td>O3</td>
                    <td>NO2</td>
                    <td>Kategori</td>
                    <td>Jarak</td>
                  </tr>
                  <?php
                  for ($j=0; $j < 5; $j++) {
                    ?>
                    <script type="text/javascript">
                    var i = smallJarak_Minkowski[<?php echo $i; ?>][<?php echo $j; ?>][0];
                    </script>
                    <tr>
                      <td>DT Latih <script>document.write(i+1)</script></td>
                      <td><script>document.write(dataLatih[i][2])</script></td>
                      <td><script>document.write(dataLatih[i][3])</script></td>
                      <td><script>document.write(dataLatih[i][4])</script></td>
                      <td><script>document.write(dataLatih[i][5])</script></td>
                      <td><script>document.write(dataLatih[i][6])</script></td>
                      <td><script>document.write(dataLatih[i][7])</script></td>
                      <td><script>document.write(smallJarak_Minkowski[<?php echo $i; ?>][<?php echo $j; ?>][1])</script></td>
                    </tr>
                    <?php
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
        <img src="../../assets/img/color1.jpg" class="blur">
      </div>

      <div class="container content-small">
        <div class="border-bottom d-flex justify-content-center align-items-center">
          <h3>3. Pengklasifikasian</h3>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-12 col-sm-12 text-center">
            <table class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
              <tr>
                <td>Data Uji</td>
                <td>Terget Klasifikasi</td>
                <td>Hasil Klasifikasi</td>
                <td>Benar / Salah</td>
              </tr>
              <?php
              // for ($i=0; $i < count($dataUji); $i++) {
              for ($i=0; $i < 10; $i++) {
                ?>
                <tr>
                  <td>DT Uji <?php echo $i + 1; ?></td>
                  <td><script>document.write(kat_Minkowski[<?php echo $i; ?>][0])</script></td>
                  <td><script>document.write(kat_Minkowski[<?php echo $i; ?>][1])</script></td>
                  <td><script>document.write(kat_Minkowski[<?php echo $i; ?>][2])</script></td>
                </tr>
                <?php
              }
              ?>
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
