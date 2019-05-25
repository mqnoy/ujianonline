<?php
$list_matpel = $models->select_matpel();
$list_kelas = $models->select_kelas();
?>
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Input pilihan ganda</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">
      <div class="box-body">
        <div class="form-group">
          <label>Kelas</label>
          <select id="cb_kelas" class="form-control" name="nm_kelas">
            <option value="0">pilih kelas</option>
            <?php
            foreach ($list_kelas as $value) {
              # code...
              echo "<option value=\"" . $value['id_kelas'] . "\">" . $value['txt_kelas'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Mata pelajaran</label>
          <select id="cb_matpel" class="form-control">
            <option  value="0">pilih mata pelajaran</option>
          </select>
        </div>
        <div class="input-group form-group col-md-2">
          <label>Nomor pertanyaan</label>
          <select id="cb_nomor_soal" class="form-control" name="nomor_soal">
          </select>
        </div>
        <div class="form-group">
          <label>Pertanyaan</label>
          <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
        </div>


        <div class="input-group form-group col-md-3">
          <span class="input-group-addon">A</span>
          <input type="email" class="form-control" placeholder="Email">
        </div>
        <div class="input-group form-group col-md-3">
          <span class="input-group-addon">B</span>
          <input type="email" class="form-control" placeholder="Email">
        </div>
        <div class="input-group form-group col-md-3">
          <span class="input-group-addon">C</span>
          <input type="email" class="form-control" placeholder="Email">
        </div>
        <div class="input-group form-group col-md-3">
          <span class="input-group-addon">D</span>
          <input type="email" class="form-control" placeholder="Email">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
      </div>
    </form>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">List data soal</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th style="width: 10px">#</th>
            <th>Task</th>
            <th>Progress</th>
            <th style="width: 40px">Label</th>
          </tr>
          <tr>
            <td>1.</td>
            <td>Update software</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
              </div>
            </td>
            <td><span class="badge bg-red">55%</span></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Clean database</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
              </div>
            </td>
            <td><span class="badge bg-yellow">70%</span></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Cron job running</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
              </div>
            </td>
            <td><span class="badge bg-light-blue">30%</span></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Fix and squish bugs</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar progress-bar-success" style="width: 90%"></div>
              </div>
            </td>
            <td><span class="badge bg-green">90%</span></td>
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