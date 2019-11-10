<?php
if(@$_SESSION['status'] == "login"){
    header("location:admin/home.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid bg-dark">
      <div class="jumbotron-background">
        <img src="../assets/img/bg1.jpg" class="blur">
      </div>
      <div class="container content-login col-md-4 col-sm-4">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-8 col-sm-8">
            <h1 style="color:white;" class="text-center">LOGIN</h1>
            <hr>
            <form class="form-group" action="../Controller/C_control.php" method="post">
              <div class="row d-flex justify-content-center align-items-center">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" value="">
              </div>
              <div class="row  d-flex justify-content-center align-items-center">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="pass" value="">
              </div>
              <div class="row  d-flex justify-content-center align-items-center">
                <input type="submit" class="btn btn-success" name="aksilogin" value="Login">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- <form class="" action="../Controller/C_form.php" method="post">
      <label for="email">E-mail</label>
      <input type="email" name="email" value="">
      <label for="pass">Password</label>
      <input type="password" name="pass" value="">
      <input type="submit" name="login" value="Login">
    </form> -->
  </body>
</html>
