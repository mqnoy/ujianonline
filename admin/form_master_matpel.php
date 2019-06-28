<?php
if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "form_mata_pelajaran") {
    ?>
    <div class="modal fade" id="modal-edit-matpel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah mata pelajaran</h4>
                </div>
                <form role="form" id="form_modal_mk">
                    <input type="hidden" name="fr_post_mastermatpel" value="post_mk" />
                    <input type="hidden" name="post_matpel_id" value="" />
                    <div class="modal-body" id="body-modal-mk">
                        <h4 id="modal-mkj-text-soal"></h4>
                        <div class="input-group margin">
                            <input type="text" name="post_text_matpel" class="form-control" value="" />
                        </div>
                        <div class="input-group margin">
                            <select class="form-control mod-edit-mk" name="matpel_kelas">
                            </select>
                        </div>
                        <p class="help-block margin"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">tutup</button>
                        <button type="button" id="btn-ubah-modal-mk" class="btn btn-primary">Ubah</button>
                    </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal modal-danger fade" id="modal-remove-matpel">
        <div class="modal-dialog">

            <div class="modal-content">
                <form role="form" id="form_del_modal_mk">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus mata pelajaran?</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                			<input type="hidden" name="fr_post_del" value="post_del_matpel"/>
                            <input type="hidden" name="text_matpel" value=""/>
                            <input type="hidden" name="text_kelas" value=""/>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn-hpus-matpel btn btn-outline">Hapus</button>
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
                <h3 class="box-title">Input mata pelajaran</h3>
                <div id="notifications" class="alert alert-warning alert-dismissible" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="form_matpel">
                <input type="hidden" name="fr_post_matpel" value="post_matpel" />
                <div class="box-body">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="matpel_kelas" id="cb_kelas">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata pelajaran</label>
                        <input type="text" name="nm_matpel" class="form-control" placeholder="contoh : matematika" required="true">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit_matpel" id="submit_matpel" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form>
        </div>

        <div class="box box-primary">
        <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">List mata pelajaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered" id="tabel_matpel">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Kelas</th>
                            <th>Mata pelajaran</th>
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