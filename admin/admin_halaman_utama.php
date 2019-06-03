<?php if ($_SESSION['is_admin'] == true && $_SESSION['is_siswa'] == false && !isset($_GET['halaman'])) { ?> 
        <div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Input pilihan ganda</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" id="form_pilihanganda">
    <input type="hidden" name="fr_post_pilihanganda" value="post_pilganda"/>
    <input type="hidden" name="soalid"/>
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

<?php
}
?>