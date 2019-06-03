<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "nilai_saya") {
$list_history_nilai=null;
if (isset($_SESSION['token_siswa'])) {
    # code...
    $token_siswa = $_SESSION['token_siswa'];
    $nis_siswa= $_SESSION['ses_nis_siswa'];
    $list_history_nilai = $models->select_nilai_bytoken($token_siswa,$nis_siswa);
    unset($_SESSION['token_siswa']);
}

?>
<div class="col-md-12">
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $_SESSION['ses_nama_siswa']." - ".$_SESSION['ses_nis_siswa'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="input-group input-group-md col-md-3">
                <input type="text" class="form-control" id="value_token" placeholder="xxxxx">
                    <span class="input-group-btn">
                      <button type="button" id="btn_token_set" class="btn btn-info btn-flat">Lihat nilai</button>
                    </span>
              </div>
              <p class="help-block">masukan token anda di kolom yang telah disediakan diatas.</p>
              <?php var_dump($list_history_nilai);?>
            </div>
            <!-- /.box-body -->
          </div>
</div>

<?php
}//end if sessions
?>