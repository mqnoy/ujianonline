<?php
session_start();
$text_info = "";
$text_desc_info = "";
$halaman_active = "Dashboard";
require_once 'includes/Query.php';
if (isset($_SESSION['is_logged']) && $_SESSION['is_admin'] == true) {
  $text_info = $_SESSION['ses_admin_username'];
  $text_desc_info = "admin";
} else if (isset($_SESSION['is_logged']) && $_SESSION['is_admin'] == false) {
  $text_info = $_SESSION['ses_nama_siswa'];
  $text_desc_info = $_SESSION['ses_nis_siswa'];
} else {
  header('Location: ./index.php?clear=true');
}
?>
<?php
include "./templates/header.php";
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="./dashboard.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>U</b>O</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ujian</b>online</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="./assets/img/avatar5.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $text_info; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="./assets/img/avatar5.png" class="img-circle" alt="User Image">
                  <p>
                    <?php echo $text_info; ?>
                    <small><?php echo $text_desc_info; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <?php if ($_SESSION['is_admin'] == true) {
                      $url_logout = "./admin.php?action=logout";
                    } else {
                      $url_logout = "./siswa.php?action=logout";
                    } ?>
                    <a href="<?php echo $url_logout; ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>

          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="./assets/img/avatar5.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $text_info; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li class="active treeview menu-open">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <?php if ($_SESSION['is_admin']) { ?>
            <li class="active treeview menu-open" >
              <a href="#">
                <i class="fa fa-edit"></i> <span>Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?halaman=form_soal"><i class="fa fa-circle-o"></i> Master soal</a></li>
                <li><a href="?halaman=master_kunci_jawaban"><i class="fa fa-circle-o"></i> Master kunci jawaban</a></li>
                <li><a href="?halaman=form_pil_ganda"><i class="fa fa-circle-o"></i> Master pilihan ganda</a></li>
                <li><a href="?halaman=form_mata_pelajaran"><i class="fa fa-circle-o"></i> Master mata pelajaran</a></li>
              </ul>
            </li>
            <li class="active treeview menu-open">
              <a href="#">
                <i class="fa fa-table"></i> <span>Report</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?halaman=nilai_siswa"><i class="fa fa-circle-o"></i> Nilai siswa</a></li>
              </ul>
            </li>
          <?php } ?>

          <?php if ($_SESSION['is_siswa']) { ?>
            <li class="active treeview menu-open">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Soal</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?halaman=list_soal"><i class="fa fa-circle-o"></i> List soal</a></li>
                <li><a href="?halaman=nilai_saya"><i class="fa fa-circle-o"></i> Lihat nilai saya</a></li>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <!-- <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $halaman_active; ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] === "rekapan") { ?>
            <!-- Info boxes -->
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">90<small>%</small></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- end of Info boxes -->
          <?php }//end of rekapan ?>
          <?php
          include_once('./siswa/siswa_list_soal.php');
          if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_soal") { ?>
            <!-- add1 -->
            <?php include "./admin/form_master_soal.php"; ?>
            <!-- add2 -->
          <?php } ?>
          <?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_pil_ganda") { ?>
            <?php include "./admin/form_master_pilihanganda.php"; ?>
          <?php } ?>

          <?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "nilai_siswa") { ?>
            <?php include "./admin/admin_list_nilai_siswa.php"; ?>
          <?php } ?>

          <?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_mata_pelajaran") { ?>
            <?php include "./admin/form_master_matpel.php"; ?>
          <?php } ?>

          <?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "master_kunci_jawaban") { ?>
            <?php include "./admin/form_master_kunci_jawaban.php"; ?>
          <?php } ?>
          </div>
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div> <strong>
      <?php var_dump($_SESSION); ?>
      <br />
      Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  </div>
  <!-- ./wrapper -->
  
  <?php include "./templates/footer.php"; ?>