<?php
$list_matpel = $models->select_matpel();
$list_kelas = $models->select_kelas();
?>
<div class="modal fade" id="modal-pilihan-ganda">
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
			<h3 class="box-title">List data soal</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="form-group col-xs-3">
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
			<div class="form-group col-xs-3">
			<label>Mata pelajaran</label>
			<select id="cb_matpel" class="form-control name="nm_matpel">
				</select>
			</div>

			<table class="table table-bordered" id="tabel_kunci_jawaban">
				<tbody>
					<tr>
						<th style="width: 10px">#</th>
						<th>nomor Soal</th>
						<th>soal</th>
						<th>jawaban</th>
						<th>mata pelajaran</th>
						<th>kelas</th>
						<th>aksi</th>
					</tr>
					<!-- <tr>
						<td>1.</td>
						<td>Update software</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td style="width: 13%">
							<div class="btn-group">
								<a class="margin" data-toggle="modal" data-target="#modal-pilihan-ganda">
									<button type="button" class="btn  btn-warning"><i class="fa fa-edit"></i></button>
								</a>
							</div>
						</td>
					</tr> -->
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