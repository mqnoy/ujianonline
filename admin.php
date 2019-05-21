<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{title}</title>
  <?php
    include "./templates/assets_header.php";
    session_start();
    require ('./includes/Query.php'); 
    if (isset($_POST['submit'])) {
      # code...
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
	    $hash_password = MD5($password);
      $check_admin = select_admin($username,$hash_password);
        if ($check_admin != NULL) {
          # code...
          foreach ($check_admin as $key => $rows) {
            # code...
            $_SESSION['ses_admin_username'] = $rows['username'];
            $_SESSION['ses_admin_password'] = $rows['password'];
            $_SESSION['is_logged'] = true;
            $_SESSION['is_admin'] = true;
            $_SESSION['is_siswa'] = false;
          }
          header('Location: ./dashboard.php?halaman=rekapan');
        }
    }
    if (isset($_GET['action']) && $_GET['action']==="logout") {
      # code...
      session_start();
      session_destroy();
      session_unset();
      header('Location: ./admin.php?msg=logout');
    }
  ?>  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./index.php">{title}</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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

<?php include "./templates/assets_footer.php"; ?>
</body>
</html>