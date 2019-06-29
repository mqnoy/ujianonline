<?php
if ($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "nilai_saya") {
  // $list_history_nilai = null;
  // if (isset($_SESSION['token_siswa'])) {
  //   # code...
  //   $token_siswa = $_SESSION['token_siswa'];
  //   $nis_siswa = $_SESSION['ses_nis_siswa'];
    // $list_history_nilai = $models->select_nilai_bytoken($token_siswa, $nis_siswa);
  //   unset($_SESSION['token_siswa']);
  // }

  ?>
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $_SESSION['ses_nama_siswa'] . " - " . $_SESSION['ses_nis_siswa']; ?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="input-group input-group-md col-md-3">
          <input type="email" class="form-control" name="email" id="value_email" placeholder="taufan@gmail.com" required=true />
          <span class="input-group-btn">
            <button type="button" id="send_nilai_toemail" class="btn btn-info btn-flat">Kirim</button>
          </span>
        </div>
        <p class="help-block">masukan email anda di kolom yang telah disediakan diatas ,<i>(list nilai yg belum pernah terkirim akan dikirimkan ke email anda .)</i></p>
      </div>
      <!-- /.box-body -->
      <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i>UjianOnline Pilihan ganda SMK v.1<small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, Inc.</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Need for Speed IV</td>
              <td>247-925-726</td>
              <td>Wes Anderson umami biodiesel</td>
              <td>$50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Monsters DVD</td>
              <td>735-845-642</td>
              <td>Terry Richardson helvetica tousled street art master</td>
              <td>$10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Grown Ups Blue Ray</td>
              <td>422-568-642</td>
              <td>Tousled lomo letterpress</td>
              <td>$25.99</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button onclick="window.print();" type="button" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print
          </button>
        </div>
      </div>
    </section>
    
    </div>
  </div>

<?php
} //end if sessions
?>