<?php if ($_SESSION['is_admin'] == true && $_SESSION['is_siswa'] == false && !isset($_GET['halaman'])) { ?> 
    
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      
      <div class="small-box bg-red">
      
        <div class="inner">
          
          <h3>0</h3>
          <p>Mata pelajaran</p>
        </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
        <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>
          <p>Soal</p>
        </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
        <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>
          <p>Siswa</p>
        </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
        <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- <div class="col-md-4">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo base_url('assets/img/user7-128x128.jpg'); ?>" alt="User Avatar">
              </div>
              <h3 class="widget-user-username">{top 1}</h3>
              <h5 class="widget-user-desc">Rangking 10 besar kelas {kelas}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Projects <span class="pull-right badge bg-blue">1</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">2</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">3</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">4</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">5</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">6</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">7</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">8</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">9</span></a></li>
                <li><a href="#">Projects <span class="pull-right badge bg-blue">10</span></a></li>
              </ul>
            </div>
          </div>
        </div> -->
        


<div class="col-md-12">
        
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Petunjuk penggunaan</h3>
    </div>
    <!-- /.box-header -->
      <div class="box-body">
        <!-- The time line -->
        <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Langkah pertama
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <!-- <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span> -->

                <h3 class="timeline-header">Tambah data <a href="<?php echo base_url('dashboard.php?halaman=form_mata_pelajaran');?>">mata pelajaran</a></h3>

                <div class="timeline-body">
                <img src="<?php echo base_url('assets/img/petunjuk_penggunaan/');?>" alt="..." class="margin">
                 
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Langkah kedua
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <!-- <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span> -->

                <h3 class="timeline-header">Tambah data <a href="<?php echo base_url('dashboard.php?halaman=form_soal');?>">soal</a></h3>

                <div class="timeline-body">
                <img src="<?php echo base_url('assets/img/petunjuk_penggunaan/');?>" alt="..." class="margin">
                  
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Langkah ketiga
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <!-- <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span> -->

                <h3 class="timeline-header">Tambah data <a href="<?php echo base_url('dashboard.php?halaman=form_pil_ganda');?>">pilihan ganda</a></h3>

                <div class="timeline-body">
                <img src="<?php echo base_url('assets/img/petunjuk_penggunaan/');?>" alt="..." class="margin">
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Langkah ke empat
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-bookmark-o bg-green"></i>

              <div class="timeline-item">
                <!-- <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span> -->

                <h3 class="timeline-header">Tentukan <a href="<?php echo base_url('dashboard.php?halaman=master_kunci_jawaban');?>">Kunci jawaban</a></h3>

                <div class="timeline-body">
                <img src="<?php echo base_url('assets/img/petunjuk_penggunaan/');?>" alt="..." class="margin">
                </div>
                <div class="timeline-footer">
                </div>
              </div>
            </li>
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
            
          </ul>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" id="">Simpan</button>
      </div>
    </form>
  </div>
  <div class="col-md-12">
          
        </div>

<?php
}
?>