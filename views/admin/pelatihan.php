<?php
include_once 'session.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Pelatihan Naive Bayes</title>
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

    <div class="container content-small">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 col-sm-4 text-center">
          <h2 style="color:white;"> <b>Pelatihan Naive Bayes</b> </h2>
          <hr>
          <form class="" action="../../Controller/C_control.php" method="get">
            <input type="hidden" name="aksi" value="latih">
            <button type="submit" class="btn btn-danger btn-lg" name="">Latih Naive Bayes</button>
          </form>
          <?php
          if (isset($data)) {
            ?>
            <h3 style="color:white;">Informasi Data Pelatihan</h3>
            <table class="table table-responsive table-borderless table-striped text-left border-top" style="color:white;">
              <tr>
                <td>Total Semua Data</td>
                <td><?php echo $data[0]; ?></td>
              </tr>
              <tr>
                <td>Total Data Kategori Baik</td>
                <td><?php echo $data[1]; ?></td>
              </tr>
              <tr>
                <td>Total Data Kategori Sedang</td>
                <td><?php echo $data[2]; ?></td>
              </tr>
              <tr>
                <td>Total Data Kategori Tidak Sehat</td>
                <td><?php echo $data[3]; ?></td>
              </tr>
              <tr>
                <td>Total Data Kategori Sangat Tidak Sehat</td>
                <td><?php echo $data[4]; ?></td>
              </tr>
            </table>
            <?php
          }
          ?>
        </div>

        <div class="col-md-1 col-sm-1 text-center">
        </div>

        <div class="col-md-5 col-sm-5 text-center">
          <h2 style="color:white;"> <b>Data Parameter Naive Bayes</b> </h2>
          <hr>

          <table class="table table-responsive table-borderless table-striped">
            <thead style="color:white;" class="border-bottom">
              <tr>
                <th class="">Parameter</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Tanggal Pelatihan</th>
              </tr>
            </thead>
            <tbody style="color:white;" class="table-wrapper-scroll-y my-custom-scrollbar-small">
              <?php
              while ($data = $dataParameter->fetch_object()) {
                ?>
                <tr >
                  <td class="text-center" width="80px"><?php echo $data->parameter; ?></td>
                  <td class="text-center" width="80px"><?php echo $data->kategori; ?></td>
                  <td class="text-center" width="80px"><?php echo $data->nilai; ?></td>
                  <td class="text-center" width="80px"><?php echo $data->tgl_pelatihan; ?></td>
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
</body>
</html>
