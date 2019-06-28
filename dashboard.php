<?php
$text_info = "";
$text_desc_info = "";
$session_level = "";
require_once 'includes/app.php';
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
                    <a href="<?php echo base_url("logout.php"); ?>" class="btn btn-default btn-flat">Sign out</a>
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
          <li class="treeview menu-open">
            <a href="#" id="dashboard_menu">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <?php if ($_SESSION['is_admin']) { ?>
            <li class="active treeview menu-open">
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
                <i class="fa fa-edit"></i> <span>Siswa</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
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
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"> Dashboard </li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
        <?php  
        if (isset($_GET['halaman']) && $_SESSION['is_logged'] == true ) {
          # code...
          $halaman = $_GET['halaman'];
          switch ($halaman) {
            case 'form_soal':
              # code...
              include_once "./admin/form_master_soal.php"; 
              break;
            case 'form_pil_ganda':
              # code...
              include_once "./admin/form_master_pilihanganda.php"; 
              break;
            case 'nilai_siswa':
              # code...
              include_once "./admin/admin_list_nilai_siswa.php"; 
              break;
            case 'form_mata_pelajaran':
              # code...
              include_once "./admin/form_master_matpel.php"; 
              break;
            case 'master_kunci_jawaban':
              # code...
              include_once "./admin/form_master_kunci_jawaban.php"; 
              break;
            case 'list_soal':
              # code...
              include_once "./siswa/siswa_list_soal.php"; 
              break;
            case 'lembar_soal_siswa':
              # code...
              include_once "./siswa/lembar_soal_siswa.php"; 
              break;
            case 'nilai_saya':
              # code...
              include_once "./siswa/nilai_saya.php"; 
              break;
            default:
              # code...
              include_once "./404.php";
              break;
          }
          }elseif ($_SESSION['is_admin'] == true && $_SESSION['is_siswa'] == false && !isset($_GET['halaman']) ){
            //halaman utama admin
            include_once "./admin/admin_halaman_utama.php";
          }elseif ($_SESSION['is_admin'] == false && $_SESSION['is_siswa'] == true && !isset($_GET['halaman']) ){
            //halaman utama siswa
            include_once "./siswa/siswa_halaman_utama.php";
          }else{
            include_once "./404.php";
          }
        ?>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      Copyright &copy; 2019 
      </div> 
      <strong>
        <!-- template by Almsaeed Studio https://adminlte.io version 2.4.0 -->
        aplikasi ujianonline smk
        </strong>
    </footer>
  </div>
  <!-- ./wrapper -->
  <?php include "./templates/footer.php"; ?>