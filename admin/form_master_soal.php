<?php
$ck_editor = true;
$list_kelas = $models->select_kelas();
if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_soal") {
  ?>
  <div class="modal fade" id="modal-edit-soal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah data soal</h4>
                </div>
                <form role="form" id="form_modal_soal">
                    <input type="hidden" name="fr_post_mastersoal" value="post_soal" />
                    <input type="hidden" name="post_matpel_id" value="" />
                    <div class="modal-body">
                    <div class="input-group">
                    <label>Nomor soal</label>
                            <input type="number" name="p_nomor_soal" class="form-control" placeholder="1" value="" />
                        </div>
                        <div class="input-group">
                        <label>Pertanyaan</label>
                            <textarea id="editor_soal" name="p_text_soal" class="form-control">
                            </textarea>
                        </div>
<!--                         
                        <div class="input-group">
                            <input type="text" name="p_matpel_id" class="form-control" placeholder="1" value="" />
                        </div> -->
                        <p class="help-block margin"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">tutup</button>
                        <button type="button" id="btn-ubah-modal-soal" class="btn btn-primary">Ubah</button>
                    </div>
            </div>
            </form>
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

      <div class="modal modal-danger fade" id="modal-remove-soal">
        <div class="modal-dialog">

            <div class="modal-content">
                <form role="form" id="form_del_modal_soal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus data soal ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                			<input type="hidden" name="fr_post_del" value="post_del_soal"/>
                            <input type="hidden" name="p_id_soal" value=""/>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn-hpus-soal btn btn-outline">Hapus</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


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
      <div class="box-body table-responsive no-padding">
        <div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <table class="table table-bordered" id="tabel_soal">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>no soal</th>
              <th>soal</th>
              <th>mata pelajaran</th>
              <th>kelas</th>
              <th>aksi</th>
            </tr>
          </thead>
          <tbody>
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
<?php
}
?>