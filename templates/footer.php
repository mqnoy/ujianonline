<!-- jQuery 3 -->
<script src="./assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="./assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="./assets/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="./assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="./assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="./assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="./assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="./assets/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="./assets/js/pages/dashboard2.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="./assets/js/demo.js"></script>


<script>
    $(function() {
        //combobox matpel sesuai dengan kelas
        $("#cb_kelas").change(function() { 
            $("#cb_matpel").hide(); 
            $("#cb_nomor_soal").hide();
            // console.log( $("#cb_kelas").val());
            
            $.ajax({
                type: "post", 
                url: "./admin/proses.php",
                data: {
                    'tampil':'cr_nama_matpel',
                    idkelas: $("#cb_kelas").val()
                }, 
                dataType: "json",
                beforeSend: function() {
                },
                success: function(response) {
                    if (response.status) {
                        // console.log(response.data);
                        $("#cb_matpel").html(response.data).show();
                    }else{
                        console.log("data tidak ada");
                    }
                },
                error: function(xhr, Status, err) {
                    $("Terjadi error : " + Status);
                }
            });
            return false;
        });
        //combobox no soal sesuai dengan kelas dan matpel
        $("#cb_matpel").change(function() { 
            console.log("matpel ganti");
            $("#cb_nomor_soal").hide(); 
            // $.ajax({
            //     type: "post", 
            //     url: "./admin/proses.php",
            //     data: {
            //         'tampil':'cr_nomor_soal',
            //         idkelas: $("#cb_kelas").val(),
            //         idmatpel: $("#cb_matpel").val()
            //     }, // data yang akan dikirim ke file yang dituju
            //     dataType: "json",
            //     beforeSend: function() {
            //     },
            //     success: function(response) {
            //         if (response.status) {
            //             console.log(response.status);
            //             console.log("dump");
            //             // $("#cb_nomor_soal").html(response.data_nomor_soal).show();
            //         }else{
            //             console.log("data tidak ada");
            //         }
            //     },
            //     error: function(xhr, Status, err) {
            //         $("Terjadi error : " + Status);
            //     }
            // });
            return false;
        });

    //ketika submit button d click
    $("#submit_matpel").click(function() {
    //do ajax proses
    $.ajax({
        url: "./admin/proses.php",
        type: "post", //form method
        data: $("#form_matpel").serialize(),
        dataType: "json", //misal kita ingin format datanya brupa json
        beforeSend: function() {
            // $('#notifications').show();
            // $("#notifications").html("Please wait....");
        },
        success: function(response) {
            if (response.status) {
                console.log(response.data);
            } else {
                // alert("harap isi smw inputan");
                // $("#notifications").html("error");
                // $('.alert .close').on('click', function(e) {
                //     $(this).parent().hide();
                // });
                window.setTimeout(function() {
                    $('#notifications').show();
                    $("#notifications").html(response.data);
                }, 2000);
                // $( '#notifications' ).attr( 'css', 'alert alert-success alert-dismissible' );   
            }
        },
        error: function(xhr, Status, err) {
            $("Terjadi error : " + Status);
        }
    });
    return false;
    })
    });
</script>

<!-- CKeditor -->
<?php
if (isset($ck_editor)) {
    ?>
    <script src="./assets/bower_components/ckeditor/ckeditor.js"></script>
    <script>
        $(function() {
            CKEDITOR.replace('editor1');
     