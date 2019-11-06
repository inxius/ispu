<div class="container">
  <!-- <a class="navbar-brand" href="#">Brand</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../../Controller/C_control.php?view=home">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="template.php">Template File</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../../Controller/C_control.php?view=data_latih">Tambah Data Latih</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../../Controller/C_control.php?view=data_uji">Tambah Data Uji</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Naive Bayes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../../Controller/C_control.php?view=pelatihan_bayes">Pelatihan</a>
          <a class="dropdown-item" href="../../Controller/C_control.php?view=bayes">Pengujian</a>
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          KNN
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="pengujian_knn.php">Pengujian</a>
        </div>
      </li>
      <!-- <li class="nav-item active">
        <a class="nav-link" href="pengujian.php">Pengujian</a>
      </li> -->
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo "{$_SESSION['name']}"; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item" href="pelatihan.php">#</a> -->
          <!-- <a class="dropdown-item" href="ubah_pass.php">Ubah Password</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../../Controller/C_control.php?view=logout">Logout</a>
        </div>
      </li>
    </div>
  </div>

  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="../../assets/js/jquery-3.2.1.slim.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
