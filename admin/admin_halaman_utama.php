<?php if ($_SESSION['is_admin'] == true && $_SESSION['is_siswa'] == false && !isset($_GET['halaman'])) { ?> 
        <div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Petunjuk penggunaan</h3>
    </div>
    <!-- /.box-header -->
      <div class="box-body">
      
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" id="">Simpan</button>
      </div>
    </form>
  </div>

<?php
}
?>