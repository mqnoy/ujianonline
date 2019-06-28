<?php
include "./templates/header.php";
require('./includes/app.php');

if (isset($_POST['login_siswa'])) {
    # code...
    // $_SESSION['nis_siswa'];
    if (empty($_POST['siswa_nis']) || empty($_POST['siswa_nama'])) {
        # code...
        header('Location: siswa.php?login_err=101');
    } else {
        $_SESSION['ses_nis_siswa'] = $_POST['siswa_nis'];
        $_SESSION['ses_nama_siswa'] = $_POST['siswa_nama'];
        $_SESSION['is_logged'] = false;
        $_SESSION['is_admin'] = false;
        $_SESSION['is_siswa'] = true;

        $nis_siswa  = $_SESSION['ses_nis_siswa'];
        $nama_siswa = $_SESSION['ses_nama_siswa'];
        
        $token_siswa= generate_tokenSiswa($nis_siswa);//params string

        $insData = array (
            'siswa_nis' => $nis_siswa,
            'siswa_nama' => $nama_siswa ,
            'siswa_kelas_id' => 0 ,
            'token_siswa' => $token_siswa ,
            'tgl_terdaftar' => tgl_waktu_skrg()
        );
        $select_siswa = $models->select_from("master_siswa","siswa_nis","=",$nis_siswa);
          if ($select_siswa == null) {
            # code...
          $insert_siswa = $models->insert_into("master_siswa",$insData);
          var_dump($insert_siswa);
          if ($insert_siswa) {
            # code...
            $_SESSION['is_logged'] = true;
            header('Location: dashboard.php');
          }else{
            $_SESSION['is_logged'] = false;
            header('Location: siswa.php?login_err=201');
          }
        }else{
          foreach ($select_siswa as $siswa) {
            # code...
            $_SESSION['ses_nis_siswa']  =$siswa['siswa_nis'];
            $_SESSION['ses_nama_siswa'] =$siswa['siswa_nama'];
          }
          $_SESSION['is_logged'] = true;
          header('Location: dashboard.php');
        }

    }
}
if (isset($_SESSION['ses_nis_siswa']) && isset($_SESSION['ses_nama_siswa']) && $_SESSION['is_logged']) {
    # code...
    // header('Location: ./dashboard.php');
}

?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./siswa.php">{title}</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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