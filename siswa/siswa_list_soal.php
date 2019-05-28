<?php 
if($_SESSION['is_siswa'] == true && isset($_GET['halaman']) && $_GET['halaman'] === "list_soal"){ 

$data_matpel_siswa = $models->select_matpel_kelas();  
$total_soal=[];
foreach ($data_matpel_siswa as $value) {
  # code...
  $i=0;
  $total_soal = $models->select_count("tabel_soal","matpel_id","=",$value['id_matpel']);
  // var_dump($total_soal);
  ?>
  <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo $value['nama_matpel'];?></span>
                <span class="info-box-number"><?php echo $total_soal[$i]['total_data'];?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      <?php echo $value['txt_kelas'];?>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
    <?php
    // $i++;
  }/** end foreach  */
  ?>

<?php 
}  
?>
