<?php
  include_once 'session.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data Uji</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
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

      <div class="container content-small col-md-10 col-sm-10">
        <h2 style="color:white;" class="text-center">Data Uji</h2>
        <hr>
        <div class="row d-flex justify-content-left align-items-left">
          <div class="col-md-12 col-sm-12 text-center">

            <form class="form-inline" action="../../Controller/C_control.php" method="post" enctype="multipart/form-data">
              <div class="input-group">
                <input type="file" class="btn btn-primary btn-fill" name="fileToUpload">
                <div class="input-group-append">
                  <input type="submit" class="btn btn-danger btn-fill" id="upload" value="Unggah Data Latih" name="upload">
                  <input type="hidden" name="aksi" value="uji">
                </div>
              </div>
              <?php
              if (isset($status)) {
                if ($status == 'gagal') {
                  echo "<b>Upload GAGAL</b>";
                }
                else {
                  echo "<b>Upload Berhasil !</b>";
                }
              }
              ?>
            </form>
          </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-12 col-sm-12 text-center">
            <table class="table table-responsive table-borderless table-striped" id="tabel_dtlatih">
              <thead style="color:white;" class="border-bottom">
                <tr>
                  <th>No.</th>
                  <th width="95px">PM10</th>
                  <th width="100px">SO2</th>
                  <th width="100px">CO</th>
                  <th width="100px">O3</th>
                  <th width="100px">NO2</th>
                  <th width="190px">Kategori</th>
                  <th width="155px">Tanggal Pengambilan</th>
                  <th width="155px">Tanggal Unggah</th>
                </tr>
              </thead>
              <tbody style="color:white;" class="table-wrapper-scroll-y my-custom-scrollbar-small">
                <?php
                if ($data == false) {
                  echo "<td>DATA KOSONG</td>";
                }
                else {
                  $i = 1;
                  while ($data_latih = $data->fetch_object()) {
                    ?>
                    <tr >
                      <td class="text-center" width="55px"><?php echo $i; ?></td>
                      <td class="text-center" width="100px"><?php echo $data_latih->pm10; ?></td>
                      <td class="text-center" width="100px"><?php echo $data_latih->so2; ?></td>
                      <td class="text-center" width="100px"><?php echo $data_latih->co; ?></td>
                      <td class="text-center" width="100px"><?php echo $data_latih->o3; ?></td>
                      <td class="text-center" width="100px"><?php echo $data_latih->no2; ?></td>
                      <td class="text-center" width="200px"><?php echo $data_latih->kategori; ?></td>
                      <td class="text-center" width="155px"><?php echo $data_latih->tanggal_pengambilan; ?></td>
                      <td class="text-center" width="155px"><?php echo $data_latih->tanggal_unggah; ?></td>
                    </tr>
                    <?php
                    $i++;
                  }
                }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    $(function(){
      $('#tabel_dtlatih tbody').scroll(function(){
        if ($('#tabel_dtlatih tbody').scrollTop() == $('#tabel_dtlatih tbody').prop('scrollHeight') - $('#tabel_dtlatih tbody').prop('offsetHeight')) {
          var isi = $('#tabel_dtlatih tbody tr').length;
          $.ajax({
            url:'C_control.php',
            data:'ajax=dtuji&batas='+isi,
            dataType:'json',
            success:function(data){
              if (data == null) {
                console.log("data null");
              }
              else {
                for (var i = 0; i < data.length; i++) {
                  var coco = "<tr><td>"+data[i][0]+"</td><td>"
                  +data[i][2]+"</td><td>"
                  +data[i][3]+"</td><td>"+data[i][4]+"</td><td>"
                  +data[i][5]+"</td><td>"+data[i][6]+"</td><td>"
                  +data[i][7]+"</td><td>"+data[i][8]+"</td><td>"
                  +data[i][9]+"</td></tr>";
                  $('#tabel_dtlatih tbody').append(coco);
                }

              }
            },
            error:function(){
              console.log("error");
            }
          });
        }
      });
    });
    </script>
  </body>
</html>
