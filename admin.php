<?php
include "./templates/header.php";
require('./includes/app.php');
if (isset($_POST['submit'])) {
  # code...
  $username = mysqli_real_escape_string($models->conn, $_POST['username']);
  $password = mysqli_real_escape_string($models->conn, $_POST['password']);
  $hash_password = MD5($password);
  $check_admin = $models->select_admin($username, $hash_password);
  if ($check_admin != NULL) {
    # code...
    foreach ($check_admin as $rows) {
      # code...
      $_SESSION['ses_admin_username'] = $rows['username'];
      $_SESSION['ses_admin_password'] = $rows['password'];
      $_SESSION['is_logged'] = true;
      $_SESSION['is_admin'] = true;
      $_SESSION['is_siswa'] = false;
      $_SESSION['halaman_aktif'] = "Dashboard";
    }
    header('Location: ./dashboard.php');
  }
}
?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index.php">{title}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group has-feedback">
          <input type="username" class="form-control" name="username" placeholder="username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="***">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
<?php
  include "./templates/footer.php";
?>