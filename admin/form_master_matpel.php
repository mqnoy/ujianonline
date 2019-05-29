<?php
$list_matpel = $models->select_matpel();
$list_kelas = $models->select_kelas();
?>
<div class="modal fade" id="modal-default">
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
            <h3 class="box-title">Input mata pelajaran</h3>
            <div id="notifications" class="alert alert-warning alert-dismissible" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
              </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="form_matpel">
            <input type="hidden" name="fr_post_matpel" value="post_matpel"/>
            <div class="box-body">
                <div class="form-group">
                    <label>Kelas</label>
                    <select class="form-control" name="matpel_kelas" id="cb_kelas">
                    </select>
                </div>
                <div class="form-group">
                    <label>Mata pelajaran</label>
                    <input type="text" name="nm_matpel" class="form-control" placeholder="contoh : matematika">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit_matpel" id="submit_matpel" class="btn btn-primary pull-right">Simpan</button>
            </div>
        </form>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">List mata pelajaran</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered" id="tabel_matpel">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Kelas</th>
                        <th>Mata pelajaran</th>
                        <th>aksi</th>
                    </tr>
                    <?php
                    $nomor = 1;
                    foreach ($list_matpel as $value) {
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td>
                                <?php echo $value['txt_kelas']; ?>
                            </td>
                            <td>
                                <?php echo $value['nama_matpel']; ?>
                            </td>
                            <td style="width: 12%">
                                <div class="btn-group">
                                <a class="margin" data-toggle="modal" data-target="#modal-default">
                                    <button type="button" class="btn  btn-warning"><i class="fa fa-edit"></i></button>
                                </a>
                                <a class="" data-toggle="modal" data-target="#modal-default">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                                </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $nomor++;
                    }
                    ?>

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