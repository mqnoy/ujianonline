<?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "nilai_siswa") { ?>
  
  <div class="col-md-12 pull-left">
    <button type="button" class="btn-print-listnilai btn btn-success pull-right"><i class="fa fa-print"></i> Print
    </button>
  </div>

  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List nilai siswa
        </h3>
        <div class="box-tools">
          <div class="will-hide input-group input-group-sm pull-right" style="width: 150px;">
            <input type="text" name="ns_keyword" id="ns_itext" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default" id="ns_btn"><i class="fa fa-search"></i></button>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <table class="table table-hover" id="tabel_data_siswa">
          <tbody>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Date</th>
              <th>Status</th>
              <th>Reason</th>
              <th>Reason</th>
              <th>Reason</th>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
<?php
}
?>