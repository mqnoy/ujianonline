<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "list_soal") {
  ?>
  <div class="modal fade" id="modal-list-soal-siswa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Soal</h4>
        </div>
        <div class="modal-body">
          <p>
            Soal yang dipilih <span id="get_soal_idmatpel"></span>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
          <button type="button" id="btn-modal-lsiswa-doit"class="btn btn-primary">Kerjakan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div id="cloning" class="col-xs-12">
  </div>
  <div id="gg" style="display:none;">
    <!-- <div class="col-lg-3 col-xs-6" id="for_clone" data-toggle="modal" data-target="#modal-list-soal-siswa" role="button"> -->
    <div class="col-lg-3 col-xs-6" id="for_clone" role="button">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3 id="put_totaldata">{asd}</h3>

          <p id="put_txtkelas"> {txt_kelas}</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" id="put_soal_namamatpel" class="small-box-footer">
          <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

  </div>
<?php
}
?>