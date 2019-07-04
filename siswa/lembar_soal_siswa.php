<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "lembar_soal_siswa"){
  // echo $_SESSION['ses_id_matpel'];
  // echo $_SESSION['ses_kelas_soal'];
?>
<div class="col-md-12">

<div class="alert alert-success alert-dismissible" id="notifications" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
              </div>
<form role="form" id="form_lembar_soal_siswa">
<input type="hidden" name="fr_post" value="post_lembarsoal_siswa"/>

<?php
  $soal_untuk_siswa  = $models->select_soal_siswa($_SESSION['ses_kelas_soal'],$_SESSION['ses_id_matpel']);
  // var_dump($soal_untuk_siswa);
  if ($soal_untuk_siswa != null) {
    # code...
  foreach ($soal_untuk_siswa as $soal) {
    # code...
    $no_soal = $soal['nomor_soal'];
  
?>
<div class="col-md-6">
<div class="box box-info[<?php echo $soal['id_soal'];?>]">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo clear_tags($soal['text_soal_sis']); ?></h3>
    </div>
    <div class="box-body">
      <?php
        $list_pilihan_ganda_soal = $models->select_pgsoal_siswa($soal['id_soal']);
        if ($list_pilihan_ganda_soal != null) {
          # code...
        foreach ($list_pilihan_ganda_soal as $pilihan_ganda) {
          # code...
            ?>
            <div class="input-group">
            <div class="radio">
              <label>
                <input type="radio" name="pilihan[<?php echo $soal['id_soal'];?>]" id="pilihanganda" value="<?php echo $pilihan_ganda['jawaban_pg'];?>">
                <?php echo $pilihan_ganda['pilihan_ganda']; ?>
              </label>
            </div>
            </div>
            <?php 
            }//end foreach pilihan ganda soal 
          }//end if check record pilihan ganda
          else{
            echo "belum ada!";
          }
      ?>
      
    </div><!-- /.box-body -->
    <div class="overlay" style="display:none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>
</div>

<?php
  }// enf of foreach
?>
<div class="col-md-2 pull-right">
<button type="submit" id="btn_form_lembarsoal" class="btn btn-block btn-success">Selesai mengerjakan</button>
</div>
<form>
<?php
}//end if null
else{
  ?>
  <div class="col-md-2 pull-left">
  belum ada soal
  <button type="submit" onclick="window.history.back()" class="btn btn-block btn btn-danger">Kembali</button>
  </div>
  <?php
}
?>

</div>
<?php
}//end if sessions

?>
