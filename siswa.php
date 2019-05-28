<?php
session_start();
if (isset($_GET['action']) && $_GET['action']=="logout") {
    # code...
    session_start();
    session_destroy();
    session_unset();
    header('Location: ./siswa.php?msg=logout');
  }
if (isset($_SESSION['ses_nis_siswa']) && isset($_SESSION['ses_nama_siswa']) && $_SESSION['is_logged']) {
    # code...
    header('Location: ./dashboard.php?halaman=list_soal');
}
?>
<!DOCTYPE html>
<html>
  <?php
    include "./templates/header.php";
  ?>  
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./siswa.php">{title}</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="./siswa/proses.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="siswa_nis" placeholder="nis">
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="siswa_nama" placeholder="nama">
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login_siswa" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include "./templates/footer.php"; ?>