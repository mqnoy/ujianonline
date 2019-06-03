<?php 
  if ($_SESSION['is_admin'] == false && $_SESSION['is_siswa'] == true && !isset($_GET['halaman'])) {
    $nama_siswa = $_SESSION['ses_nama_siswa'];
    $nis_siswa = $_SESSION['ses_nis_siswa'];
    if(!isset($_SESSION['ses_id_matpel'])){
    ?>
    <!--start dashboard siswa-->
      <div class="col-md-12">
        <div class="col-md-6">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/img/user4-128x128.jpg'); ?>" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo $nama_siswa; ?></h3>
              <p class="text-muted text-center"><?php echo $nis_siswa; ?></p>
              <div class="form-group">
                <label>Kelas</label>
                <select class="form-control" name="name_kelas_siswa" id="cb_kelas_siswa">
                </select></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

  <?php 
    }else{
      ?>
      <div class="col-md-2">
      <button type="button" onclick="location.href = '<?php echo base_url('dashboard.php?halaman=list_soal'); ?>';" class="btn btn-block btn-info btn-lg">Kerjakan soal</button>
      </div>
      
      <?php
    }
  } 
?>
<!--end of dashboard siswa-->