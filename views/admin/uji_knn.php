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
            <table id="tbjarak_eucli" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
              <table id="tbsjarak_eucli" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
              <table id="tbk_eucli" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                <thead>
                  <tr>
                    <td>Data Uji</td>
                    <td>Terget Klasifikasi</td>
                    <td>Hasil Klasifikasi</td>
                    <td>Benar / Salah</td>
                  </tr>
                </thead>

                <tbody>

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
            <h1>Perhitungan KNN Metode Manhattan</h1>
          </div>

          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>1. Perhitungan Jarak</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table id="tbjarak_manhat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
                <table id="tbsjarak_manhat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
                <table id="tbk_manhat" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
                  <thead>
                    <tr>
                      <td>Data Uji</td>
                      <td>Terget Klasifikasi</td>
                      <td>Hasil Klasifikasi</td>
                      <td>Benar / Salah</td>
                    </tr>
                  </thead>
                  <tbody>

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
            <h1>Perhitungan KNN Metode Minkowski</h1>
          </div>

          <div class="border-bottom d-flex justify-content-center align-items-center">
            <h3>1. Perhitungan Jarak</h3>
          </div>

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-sm-12 text-center">
              <table id="tbjarak_minkow" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
              <table id="tbsjarak_minkow" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">

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
            <table id="tbk_minkow" class="table table-responsive table-borderless table-striped table-wrapper-scroll-y my-custom-scrollbar">
              <thead>
                <tr>
                  <td>Data Uji</td>
                  <td>Terget Klasifikasi</td>
                  <td>Hasil Klasifikasi</td>
                  <td>Benar / Salah</td>
                </tr>
              </thead>
              <tbody>

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

        $(document).ready(function(){
          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="4" class="text-center">DT Uji'
                        +(i + 1)+'</td></tr>';
            $('#tbjarak_eucli').append(coco);
            for (var j = 0; j < 5; j++) {
              var cici = '<tr><td>DT Latih '
              +(j + 1)+'</td><td><h5><sub>&radic; <span style="text-decoration:overline;">'
              +dataUji[i][2]+' - '+dataLatih[j][2]+'<sup>2</sup> + '
              +dataUji[i][3]+' - '+dataLatih[j][3]+'<sup>2</sup> + '
              +dataUji[i][4]+' - '+dataLatih[j][4]+'<sup>2</sup> + '
              +dataUji[i][5]+' - '+dataLatih[j][5]+'<sup>2</sup> + '
              +dataUji[i][6]+' - '+dataLatih[j][6]+'<sup>2</sup></span></sub></5></td><td> = </td><td>'
              +jarak_Eucli[i][j]+'</td></tr>';
              $('#tbjarak_eucli').append(cici);
            }
          }

          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="8" class="text-center">DT Uji'
              +(i + 1)+'</td></tr>'
              +'<tr><td>Data Lati</td>'
              +'<td>PM10</td>'
              +'<td>SO2</td>'
              +'<td>CO</td>'
              +'<td>O3</td>'
              +'<td>NO2</td>'
              +'<td>Kategori</td>'
              +'<td>Jarak</td></tr>';
              $('#tbsjarak_eucli').append(coco);

              for (var j = 0; j < 5; j++) {
                var k = smallJarak_Eucli[i][j][0];
                var cici = '<tr><td>DT Latih'+(k + 1)+'</td>'
                +'<td>'+dataLatih[k][2]+'</td>'
                +'<td>'+dataLatih[k][3]+'</td>'
                +'<td>'+dataLatih[k][4]+'</td>'
                +'<td>'+dataLatih[k][5]+'</td>'
                +'<td>'+dataLatih[k][6]+'</td>'
                +'<td>'+dataLatih[k][7]+'</td>'
                +'<td>'+smallJarak_Eucli[i][j][1]+'</td></tr>';
                $('#tbsjarak_eucli').append(cici);
              }
          }

          for (var i = 0; i < 15; i++) {
            var coco = '<tr><td>DT Uji'+(i + 1)+'</td>'
            +'<td>'+kat_Eucli[i][0]+'</td>'
            +'<td>'+kat_Eucli[i][1]+'</td>'
            +'<td>'+kat_Eucli[i][2]+'</td></tr>';
            $('#tbk_eucli tbody').append(coco);
          }

          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="4" class="text-center">DT Uji'+(i + 1)+'</td></tr>';
            $('#tbjarak_manhat').append(coco);
            for (var j = 0; j < 5; j++) {
              var cici ='<tr><td>DT Latih '+(j + 1)+"</td><td>|"
              +dataUji[i][2]+" - "+dataLatih[j][2]+"| + |"
              +dataUji[i][3]+" - "+dataLatih[j][3]+"| + |"
              +dataUji[i][4]+" - "+dataLatih[j][4]+"| + |"
              +dataUji[i][5]+" - "+dataLatih[j][5]+"| + |"
              +dataUji[i][6]+" - "+dataLatih[j][6]+"|</td><td> = </td><td>"
              +jarak_Manhattan[i][j]+"</td></tr>";
              $('#tbjarak_manhat').append(cici);
            }
          }

          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="8" class="text-center">DT Uji'
              +(i + 1)+'</td></tr>'
              +'<tr><td>Data Lati</td>'
              +'<td>PM10</td>'
              +'<td>SO2</td>'
              +'<td>CO</td>'
              +'<td>O3</td>'
              +'<td>NO2</td>'
              +'<td>Kategori</td>'
              +'<td>Jarak</td></tr>';
              $('#tbsjarak_manhat').append(coco);

              for (var j = 0; j < 5; j++) {
                var k = smallJarak_Manhattan[i][j][0];
                var cici = '<tr><td>DT Latih'+(k + 1)+'</td>'
                +'<td>'+dataLatih[k][2]+'</td>'
                +'<td>'+dataLatih[k][3]+'</td>'
                +'<td>'+dataLatih[k][4]+'</td>'
                +'<td>'+dataLatih[k][5]+'</td>'
                +'<td>'+dataLatih[k][6]+'</td>'
                +'<td>'+dataLatih[k][7]+'</td>'
                +'<td>'+smallJarak_Manhattan[i][j][1]+'</td></tr>';
                $('#tbsjarak_manhat').append(cici);
              }
          }

          for (var i = 0; i < 15; i++) {
            var coco = '<tr><td>DT Uji'+(i + 1)+'</td>'
            +'<td>'+kat_Manhattan[i][0]+'</td>'
            +'<td>'+kat_Manhattan[i][1]+'</td>'
            +'<td>'+kat_Manhattan[i][2]+'</td></tr>';
            $('#tbk_manhat tbody').append(coco);
          }

          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="4" class="text-center">DT Uji'+(i + 1)+'</td></tr>';
            $('#tbjarak_minkow').append(coco);
            for (var j = 0; j < 5; j++) {
              var cici ='<tr><td>DT Latih '+(j + 1)+"</td><td><sub>( |"
              +dataUji[i][2]+" - "+dataLatih[j][2]+"|<sup>3</sup> + |"
              +dataUji[i][3]+" - "+dataLatih[j][3]+"|<sup>3</sup> + |"
              +dataUji[i][4]+" - "+dataLatih[j][4]+"|<sup>3</sup> + |"
              +dataUji[i][5]+" - "+dataLatih[j][5]+"|<sup>3</sup> + |"
              +dataUji[i][6]+" - "+dataLatih[j][6]+"|<sup>3</sup> )</sub><sup>1/3</sup>"
              +"</td><td> = </td><td>"+jarak_Manhattan[i][j]+"</td></tr>";
              $('#tbjarak_minkow').append(cici);
            }
          }

          for (var i = 0; i < 10; i++) {
            var coco = '<tr><td colspan="8" class="text-center">DT Uji'
              +(i + 1)+'</td></tr>'
              +'<tr><td>Data Lati</td>'
              +'<td>PM10</td>'
              +'<td>SO2</td>'
              +'<td>CO</td>'
              +'<td>O3</td>'
              +'<td>NO2</td>'
              +'<td>Kategori</td>'
              +'<td>Jarak</td></tr>';
              $('#tbsjarak_minkow').append(coco);

              for (var j = 0; j < 5; j++) {
                var k = smallJarak_Minkowski[i][j][0];
                var cici = '<tr><td>DT Latih'+(k + 1)+'</td>'
                +'<td>'+dataLatih[k][2]+'</td>'
                +'<td>'+dataLatih[k][3]+'</td>'
                +'<td>'+dataLatih[k][4]+'</td>'
                +'<td>'+dataLatih[k][5]+'</td>'
                +'<td>'+dataLatih[k][6]+'</td>'
                +'<td>'+dataLatih[k][7]+'</td>'
                +'<td>'+smallJarak_Minkowski[i][j][1]+'</td></tr>';
                $('#tbsjarak_minkow').append(cici);
              }
          }

          for (var i = 0; i < 15; i++) {
            var coco = '<tr><td>DT Uji'+(i + 1)+'</td>'
            +'<td>'+kat_Minkowski[i][0]+'</td>'
            +'<td>'+kat_Minkowski[i][1]+'</td>'
            +'<td>'+kat_Minkowski[i][2]+'</td></tr>';
            $('#tbk_minkow tbody').append(coco);
          }

        });

        $('#tbk_eucli').scroll(function(){
          if ($('#tbk_eucli').scrollTop() == $('#tbk_eucli').prop('scrollHeight') - $('#tbk_eucli').prop('offsetHeight')) {
            var isi = $('#tbk_eucli tbody tr').length;
            for (var i = 0; i < 10; i++) {
              var j = isi + i;
              var coco = '<tr><td>DT Uji'+(j + 1)+'</td>'
              +'<td>'+kat_Eucli[j][0]+'</td>'
              +'<td>'+kat_Eucli[j][1]+'</td>'
              +'<td>'+kat_Eucli[j][2]+'</td></tr>';
              $('#tbk_eucli tbody').append(coco);
            }
          }
        });

        $('#tbk_manhat').scroll(function(){
          if ($('#tbk_manhat').scrollTop() == $('#tbk_manhat').prop('scrollHeight') - $('#tbk_manhat').prop('offsetHeight')) {
            var isi = $('#tbk_manhat tbody tr').length;
            for (var i = 0; i < 10; i++) {
              var j = isi + i;
              var coco = '<tr><td>DT Uji'+(j + 1)+'</td>'
              +'<td>'+kat_Manhattan[j][0]+'</td>'
              +'<td>'+kat_Manhattan[j][1]+'</td>'
              +'<td>'+kat_Manhattan[j][2]+'</td></tr>';
              $('#tbk_manhat tbody').append(coco);
            }
          }
        });

        $('#tbk_minkow').scroll(function(){
          if ($('#tbk_minkow').scrollTop() == $('#tbk_minkow').prop('scrollHeight') - $('#tbk_minkow').prop('offsetHeight')) {
            var isi = $('#tbk_minkow tbody tr').length;
            for (var i = 0; i < 10; i++) {
              var j = isi + i;
              var coco = '<tr><td>DT Uji'+(j + 1)+'</td>'
              +'<td>'+kat_Minkowski[j][0]+'</td>'
              +'<td>'+kat_Minkowski[j][1]+'</td>'
              +'<td>'+kat_Minkowski[j][2]+'</td></tr>';
              $('#tbk_minkow tbody').append(coco);
            }
          }
        });
      });
      </script>
    </body>
    </html>
