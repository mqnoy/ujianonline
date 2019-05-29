<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "list_soal") {

$getsoal_session = isset($_SESSION['get_kelas']) ? $_SESSION['get_kelas'] : null ;
 
  $data_matpel_siswa = $models->select_matpel_kelas($getsoal_session);
  $total_soal = [];
  $nama_siswa = $_SESSION['ses_nama_siswa'];
  $nis_siswa = $_SESSION['ses_nis_siswa'];
  ?>
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/img/user4-128x128.jpg');?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $nama_siswa;?></h3>

        <p class="text-muted text-center"><?php echo $nis_siswa;?></p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>

        <div class="form-group">
          <label>Kelas</label>
          <select class="form-control" name="name_kelas" id="cb_kelas_siswa">
          </select></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>

  <?php
  foreach ($data_matpel_siswa as $value) {
    # code...
    $i = 0;
    $total_soal = $models->select_count("tabel_soal", "matpel_id", "=", $value['id_matpel']);
    // var_dump($total_soal);
    ?>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><?php echo $value['nama_matpel']; ?></span>
          <span class="info-box-number"><?php echo $total_soal[$i]['total_data']; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            <?php echo $value['txt_kelas']; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php
  // $i++;
}
/** end foreach  */
?>

<?php
}
?>