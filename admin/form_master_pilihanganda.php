<?php
$ck_editor = true;
$list_kelas = $models->select_kelas();
$anu = $models->select_pilihan_ganda();

if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_pil_ganda") {
  ?>
  <div class="modal fade" id="modal-edit-mpg">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah text pilihan ganda</h4>
        </div>
        <form role="form" id="form_modal_mpg">
          <input type="hidden" name="fr_post_master_pilihanganda" value="post_mpg" />
          <input type="hidden" name="post_pg_id" value="" />
          <input type="hidden" name="post_soal_id" value="" />
          <div class="modal-body">
            <div class="input-group">
              <label>Text jawaban pilihan ganda : </label>
              <input type="text" name="post_pg_text" class="form-control" placeholder="text pg">
            </div>
            <p class="help-block margin"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">tutup</button>
            <button type="button" id="btn-ubah-modal-mpg" class="btn btn-primary">Ubah</button>
          </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal modal-danger fade" id="modal-remove-mpg">
    <div class="modal-dialog">

      <div class="modal-content">
        <form role="form" id="form_del_modal_mpg">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus pilihan ganda?</h4>
          </div>
          <div class="modal-body">
            <p>
              <input type="hidden" name="fr_post_del" value="post_del_mpg" />
              <input type="hidden" name="post_pg_id" value="" />
              <input type="hidden" name="post_soal_id" value="" />
              <p class="help-block margin" style="color:white !important;">
                Perhatian ! ,menghapus satu pilihan ganda akan menghapus semuanya 
              </p>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn-hpus-mpg btn btn-outline">Hapus</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Input pilihan ganda</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="form_pilihanganda">
        <input type="hidden" name="fr_post_pilihanganda" value="post_pilganda" />
        <input type="hidden" name="soalid" />
        <div class="box-body">
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control" name="matpel_kelas" id="cb_kelas">
            </select>
          </div>
          <div class="form-group">
            <label>Mata pelajaran</label>
            <select id="cb_matpel" class="form-control">
            </select>
          </div>
          <div class="input-group form-group col-md-2">
            <label>Nomor pertanyaan</label>
            <select id="cb_nomor_soal" class="form-control" name="nomor_soal">
            </select>
          </div>
          <div class="form-group" id="group_pertanyaan" style="display:none;">
            <label>Pertanyaan</label>
            <textarea id="editor1" name="txt_pertanyaan" rows="10" cols="80" disabled></textarea>
          </div>

          <div class="input-group col-md-3" id="group_pg_soal" style="display:none;">
            <div class="input-group margin">
              <span class="input-group-addon">A</span>
              <input type="text" name="pg_soal[]" class="form-control" placeholder="pilihan ganda A">
            </div>
            <div class="input-group margin">
              <span class="input-group-addon">B</span>
              <input type="text" name="pg_soal[]" class="form-control" placeholder="pilihan ganda B">
            </div>
            <div class="input-group margin">
              <span class="input-group-addon">C</span>
              <input type="text" name="pg_soal[]" class="form-control" placeholder="pilihan ganda C">
            </div>
            <div class="input-group margin">
              <span class="input-group-addon">D</span>
              <input type="text" name="pg_soal[]" class="form-control" placeholder="pilihan ganda D">
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" id="submit_pilganda">Simpan</button>
        </div>
      </form>
    </div>

    <div class="box box-primary">
      <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      <div class="box-header with-border">
        <h3 class="box-title">List data soal</h3>
      </div>

      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
      <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
        <table class="table table-bordered" id="tabel_piihanganda">
          <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>nomor soal</th>
              <th>soal</th>
              <th>pilihan ganda</th>
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

<?php
}
?>