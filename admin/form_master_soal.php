<?php
$ck_editor = true;
$list_kelas = $models->select_kelas();
?>
<div class="modal fade" id="modal-soal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Input Soal</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" id="form_soal">
      <input type="hidden" name="fr_post_soal" value="post_soal" />

      <div class="box-body">
        <div class="form-group">
          <label>Kelas</label>
          <select id="cb_kelas" class="form-control" name="nm_kelas">
            </select>
        </div>
        <div class="form-group">
          <label>Mata pelajaran</label>
          <select id="cb_matpel" class="form-control" name="nm_matpel">
            <option>pilih mata pelajaran</option>
          </select>
        </div>
        <div class="input-group form-group col-md-2" id="group_no_pertanyaan">
          <label for="input_nomor_soal">Nomor pertanyaan</label>
          <input type="number" name="no_pertanyaan" max=40 class="form-control " id="input_nomor_soal" placeholder="1">
        </div>
        <div class="form-group" id="group_pertanyaan">
          <label>Pertanyaan</label>
          <textarea id="editor1" name="txt_pertanyaan" rows="10" cols="80"></textarea>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" id="submit_soal">Simpan</button>
      </div>
    </form>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">List data soal</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered" id="tabel_soal">
        <tbody>
          <tr>
            <th style="width: 10px">#</th>
            <th>no soal</th>
            <th>soal</th>
            <th>mata pelajaran</th>
            <th>kelas</th>
            <th>aksi</th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">«</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">»</a></li>
      </ul>
    </div>

  </div>

</div>