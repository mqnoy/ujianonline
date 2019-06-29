<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "nilai_saya") {
  // $list_history_nilai = null;
  // if (isset($_SESSION['token_siswa'])) {
  //   # code...
  //   $token_siswa = $_SESSION['token_siswa'];
  //   $nis_siswa = $_SESSION['ses_nis_siswa'];
    // $list_history_nilai = $models->select_nilai_bytoken($token_siswa, $nis_siswa);
  //   unset($_SESSION['token_siswa']);
  // }

  ?>
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $_SESSION['ses_nama_siswa'] . " - " . $_SESSION['ses_nis_siswa']; ?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body will-hide">
        <div class="input-group input-group-md col-md-3">
          <input type="email" class="form-control" name="email" id="value_email" placeholder="taufan@gmail.com" required=true />
          <span class="input-group-btn">
            <button type="button" id="send_nilai_toemail" class="btn btn-info btn-flat">Kirim</button>
          </span>
        </div>
        <p class="help-block">masukan email anda di kolom yang telah disediakan diatas ,<i>(list nilai yg belum pernah terkirim akan dikirimkan ke email anda .)</i></p>
      </div>
      <!-- /.box-body -->
      <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
        <center> <h2 class="page-header">
         UjianOnline Pilihan ganda SMK 
          </h2>
          Lorem ipsum dolor sit amet consectetur.
          </center>
          <br/>
            <small class="pull-right">Date: <?php echo tgl_waktu_skrg();?></small>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong><?php echo $_SESSION['ses_nama_siswa'];?>.</strong><br>
            <?php echo $_SESSION['ses_nis_siswa'];?><br>
          </address>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" id="table_nilai_saya">
            <thead>
            <tr>
              <th>#</th>
              <th>Mata pelajaran</th>
              <th>Nilai</th>
              <th>Tanggal pengerjaan</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn-print-nilai btn btn-success pull-right"><i class="fa fa-print"></i> Print
          </button>
        </div>
      </div>
    </section>
    
    </div>
  </div>

<?php
} //end if sessions
?>