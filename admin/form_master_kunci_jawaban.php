<?php if ($_SESSION['is_admin'] && isset($_GET['halaman']) && $_GET['halaman'] == "master_kunci_jawaban") { 


 
?>
<div class="modal fade" id="modal-kunci-jawaban">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Terapkan kunci jawaban</h4>
			</div>
			<form role="form" id="form_modal_mkj">
			<input type="hidden" name="fr_post_masterkuncijwbn" value="post_mkj"/>
			<input type="hidden" name="post_soal_id" value=""/>
			<div class="modal-body" id="body-modal-mkj">
				<h4 id="modal-mkj-text-soal"></h4>
					<div class="input-group" id="modal-mkj-pilihan-ganda">
						<div class="radio">
							<label>
								<input type="radio" name="pilihan[]" id="pilihanganda" value="">
							</label>
						</div>
					</div>
					<div class="input-group margin">
						<span class="input-group-addon">bobot</span>
						<input type="number" name="post_pg_bobot" class="form-control" placeholder="10">
					</div>
					<p class="help-block margin"></p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">tutup</button>
				<button type="button" id="btn-pilih-modal-mkj" class="btn btn-primary">Pilih kunci jawaban</button>
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
			<h3 class="box-title">List data kunci jawaban</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="form-group col-xs-3">
                    <label>Kelas</label>
                    <select class="form-control" name="matpel_kelas" id="cb_kelas">
                    </select>
			</div>
			<div class="form-group col-xs-3">
			<label>Mata pelajaran</label>
			<select id="cb_matpel" class="form-control" name="nm_matpel">
				</select>
			</div>
			<div class="box-body table-responsive no-padding">
			<table class="table table-bordered " id="tabel_kunci_jawaban">
				<tbody>
					<tr>
						<th style="width: 10px">#</th>
						<th>nomor Soal</th>
						<th>soal</th>
						<th>jawaban</th>
						<th>bobot</th>
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
</div>
<?php 
}
?>