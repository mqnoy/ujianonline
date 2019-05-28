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
<!-- CKeditor -->
<script src="./assets/bower_components/ckeditor/ckeditor.js"></script>


<script>
    $(function() {
        //combobox matpel sesuai dengan kelas
        $("#cb_matpel").hide();
        $("#cb_nomor_soal").hide();
        $("#cb_kelas").change(function() {
            // console.log( $("#cb_kelas").val());
            $.ajax({
                type: "post",
                url: "./admin/proses.php",
                data: {
                    'tampil': 'cr_nama_matpel',
                    idkelas: $("#cb_kelas").val()
                },
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {
                    if (response.status) {
                        // console.log(response.data);
                        $("#cb_matpel").html(response.data).show();
                    } else {
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
            $.ajax({
                type: "post",
                url: "./admin/proses.php",
                data: {
                    'tampil': 'cr_nomor_soal',
                    idkelas: $("#cb_kelas").val(),
                    idmatpel: $("#cb_matpel").val()
                },
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {
                    if (response.status) {
                        $("#cb_nomor_soal").html(response.data).show();
                    } else {
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
        $("#cb_nomor_soal").change(function() {
            console.log("nomor soal ganti");
            $.ajax({
                type: "post",
                url: "./admin/proses.php",
                data: {
                    'tampil': 'cr_txt_pertanyaan',
                    idkelas: $("#cb_kelas").val(),
                    idmatpel: $("#cb_matpel").val(),
                    nomorsoal: $("#cb_nomor_soal").val()
                },
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {
                    if (response.status) {
                        // show pg
                        $("#group_pg_soal").show();
                        $("#group_pg_pertanyaan").show();

                        // $("textarea[name='txt_pertanyaan']").html("askodoaskdosa");
                        var datasoal = JSON.parse(JSON.stringify(response.data)); 
                        console.log(datasoal);
                        // 
                        $("[name='soalid']").val(datasoal.id_soal);
                        CKEDITOR.instances.editor1.setData(datasoal.text_soal, function() {
                            this.checkDirty(); // true
                        });
                    } else {
                        $("#group_pg_soal").hide();
                        console.log("data tidak ada");
                    }
                },
                error: function(xhr, Status, err) {
                    $("Terjadi error : " + Status);
                }
            });
            return false;
        });

        //ketika submit button matpel d click
        $("#submit_matpel").click(function() {
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
        });
        
        //submit form pil ganda
        //ketika submit button pilganda d click
        $("#submit_pilganda").click(function() {
            $.ajax({
                url: "./admin/proses.php",
                type: "post", //form method
                data: $("#form_pilihanganda").serialize(),
                dataType: "json", //misal kita ingin format datanya brupa json
                beforeSend: function() {
                    // $('#notifications').show();
                    // $("#notifications").html("Please wait....");
                },
                success: function(response) {
                    if (response.status) {
                        console.log(response.data);
                    } else {
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
        });

        //ketika submit button soal
        $("#submit_soal").click(function() {
            var value = CKEDITOR.instances['editor1'];
            console.log(value);
            $.ajax({
                url: "./admin/proses.php",
                type: "post", //form method
                data: {
                    'fr_post_soal' : $("[name='fr_post_soal']").val(),
                    'nm_kelas' : $("#cb_kelas").val(),
                    'nm_matpel' : $("#cb_matpel").val(),
                    'no_pertanyaan' : $("#input_nomor_soal").val(),
                    'txt_pertanyaan' : value.getData()
                },
                    // 'form_data' : $("#form_soal").serialize() ,
                    
                dataType: "json", //misal kita ingin format datanya brupa json
                beforeSend: function() {
            console.log(value);

                    // $('#notifications').show();
                    // $("#notifications").html("Please wait....");
                },
                success: function(response) {
                    if (response.status) {
                        console.log(response.data);
                    } else {
                        window.setTimeout(function() {
                            $('#notifications').show();
                            $("#notifications").html(response.data);
                        }, 2000);
                        // $( '#notifications' ).attr( 'css', 'alert alert-success alert-dismissible' );   
                    }
                },
                // error: function(xhr, Status, err) {
                //     $("Terjadi error : " + Status);
                // }
            });
            return false;
        });

        // menampilkan list data untuk data kunci jawaban 
        function tampil_data_kunci_jwbn(){
            $.ajax({
                url : "admin/proses.php",
                type : "post",
                data : {
                    'tampil': 'tam_kunci_jawaban'
                },
                dataType : "json",
                beforeSend:function () {
                    
                },
                success: function (response) {
                    if(response.status){
                        console.log(response.data);
                        // $('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
                        $("#tabel_kunci_jawaban tr:last").after(response.data);
                    }else{
                        console.log("false");
                    }
                },
                error : function (xhr, Status, err) {
                    $("terjadi error : "+ Status);
                    
                }

            });
            return false;
        }


        tampil_data_kunci_jwbn();
        <?php
        if (isset($ck_editor)) {
            ?>
            CKEDITOR.replace('editor1');
        <?php
    }
    ?>

    });//end of document ready function
</script>

</body>

</html>