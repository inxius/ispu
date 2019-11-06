<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pengujian Naive Bayes</title>
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

      <div class="container content">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-6 col-sm-6 text-center">
            <h2 style="color:white;"><b>Pengujian Dengan Data Uji</b></h2>
            <hr>
            <form class="" action="../../Controller/C_control.php" method="get">
              <input type="hidden" name="aksi" value="uji_bayes">
              <input type="submit" class="btn btn-danger btn-fill" name="" value="Proses Uji">
            </form>

            <?php
            if (isset($status)) {
              if (!$status) {
                ?>
                <hr>
                <p class="text-center"> <b>Data Uji atau Data Latih Masih Kosong !</b> </p>
                <?php
              }
            }
             ?>
          </div>

          <div class="col-md-6 col-sm-6 border-left">
            <h2 class="text-center" style="color:white;"><b>Pengujian 1 Data</b></h2>
            <hr>
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-md-8 col-sm-8">
                <form class="" action="../../Controller/C_control.php" method="get">
                  <div class="text-center">
                    <div class="row form-group">
                      <label for="pm10" class="col-md-4 col-sm-4 col-form-label" style="color:white;"> <b>Index PM10</b> </label>
                      <div class="col-md-8 col-sm-8">
                        <input type="number" max="500" min="0" step="1" class="form-control" name="pm10" value="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="so2" class="col-md-4 col-sm-4 col-form-label" style="color:white;"> <b>Index SO2</b> </label>
                      <div class="col-md-8 col-sm-8">
                        <input type="number" max="500" min="0" step="1" class="form-control" name="so2" value="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="co" class="col-md-4 col-sm-4 col-form-label" style="color:white;"> <b>Index CO</b> </label>
                      <div class="col-md-8 col-sm-8">
                        <input type="number" max="500" min="0" step="1" class="form-control" name="co" value="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="o3" class="col-md-4 col-sm-4 col-form-label" style="color:white;"> <b>Index O3</b> </label>
                      <div class="col-md-8 col-sm-8">
                        <input type="number" max="500" min="0" step="1" class="form-control" name="o3" value="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="no2" class="col-md-4 col-sm-4 col-form-label" style="color:white;"> <b>Index NO2</b> </label>
                      <div class="col-md-8 col-sm-8">
                        <input type="number" max="500" min="0" step="1" class="form-control" name="no2" value="" required>
                      </div>
                    </div>
                  </div>

                  <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-sm-6 text-center">
                      <input type="hidden" name="aksi" value="klasifikasi_bayes">
                      <input type="submit" class="btn btn-primary btn-fill" name="" value="Proses Uji">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
