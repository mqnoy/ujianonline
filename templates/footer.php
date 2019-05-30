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
    var url_static = "<?php echo base_url('includes/ajax.php'); ?>";
    $(function() {
         //
         $("#cloning #for_clone").click(function() {
                alert("clicked");
            });
            //
        //combobox matpel sesuai dengan kelas
        $("#cb_matpel").hide();
        $("#cb_nomor_soal").hide();
        $("#group_pertanyaan").hide();
        $("#group_no_pertanyaan").hide();

        <?php
        if ($_SESSION['is_logged'] == true && $_SESSION['is_siswa'] == true) {
            # code...
            ?>
            //tampil data soal untuk siswa
            function fetching_data_soal_list() {
                console.log("fetching data div");
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'data_listsoal_siswa',
                    },
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        if (response.status) {
                            var div_put;
                            var data_soal_siswa_db = JSON.parse(JSON.stringify(response.data));
                            $.each(data_soal_siswa_db, function(index, item) {
                                $("#for_clone").clone().appendTo("#cloning");
                                $('#gg').remove();
                                $("#for_clone").find("#put_soal_namamatpel").html(item.arr_matpel);
                                $("#for_clone").find("#put_totaldata").html(item.arr_totaldata);
                                $("#for_clone").find("#put_txtkelas").html(item.arr_kelas);

                            });
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("Terjadi error : " + Status);
                    }
                });
            }
            fetching_data_soal_list();

           
            //tampil data kelas untuk siswa
            function fetching_data_kelas_siswa() {
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'cb_data_kelas',
                    },
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            $("#cb_kelas_siswa").html(response.data).show();
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
            }
            fetching_data_kelas_siswa();
            //pemilihan kelas untuk siswa
            $("select[name='name_kelas_siswa']").change(function() {
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'aksi_siswa': 'terapkan_kelas',
                        set_kelas: $("#cb_kelas_siswa").val()
                    },
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        if (response.status) {
                            console.log(response);
                            window.location.href = "<?php echo base_url('dashboard.php?halaman=list_soal'); ?>";
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
                return false;
            });
        <?php
    } //end of session siswa

    if ($_SESSION['is_logged'] == true && $_SESSION['is_admin'] == true) {
        ?>
            //tampil data kelas untuk admin
            function fetching_data_kelas() {
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'cb_data_kelas',
                    },
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            $("#cb_kelas").html(response.data).show();
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
            }

            fetching_data_kelas();

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
                $("#group_pertanyaan").show();
                $("#group_no_pertanyaan").show();

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
                            $("#group_pertanyaan").show();

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
                            // console.log(response.data);

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
                            //coba w/o refresh
                            tampil_data_pilihan_ganda();
                            // $("#tabel_piihanganda").hide();
                            // $("#tabel_piihanganda").show();
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
                        'fr_post_soal': $("[name='fr_post_soal']").val(),
                        'nm_kelas': $("#cb_kelas").val(),
                        'nm_matpel': $("#cb_matpel").val(),
                        'no_pertanyaan': $("#input_nomor_soal").val(),
                        'txt_pertanyaan': value.getData()
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
            function tampil_data_kunci_jwbn() {
                $.ajax({
                    url: "admin/proses.php",
                    type: "post",
                    data: {
                        'tampil': 'tam_kunci_jawaban'
                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            // $('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
                            $("#tabel_kunci_jawaban tr:last").after(response.data);
                        } else {
                            console.log("false");
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("terjadi error : " + Status);

                    }

                });
                return false;
            }

            // menampilkan list data untuk pilihan ganda 
            function tampil_data_pilihan_ganda() {
                $.ajax({
                    url: "admin/proses.php",
                    type: "post",
                    data: {
                        'tampil': 'tam_pilihan_ganda'
                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(response) {
                        if (response.status) {
                            console.log(response.data);
                            // $('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
                            $("#tabel_piihanganda tr:last").after(response.data);
                        } else {
                            console.log("false");
                        }
                    },
                    // error : function (xhr, Status, err) {
                    //     $("terjadi error : "+ Status);

                    // }

                });
                return false;
            }

            // menampilkan list data untuk pilihan ganda 
            function tampil_data_soal() {
                $.ajax({
                    url: "admin/proses.php",
                    type: "post",
                    data: {
                        'fetch': 'data_tabel_soal'
                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(response) {
                        if (response.status) {
                            console.log(response.data);
                            // $('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
                            $("#tabel_soal tr:last").after(response.data);
                        } else {
                            console.log("false");
                        }
                    },
                    // error : function (xhr, Status, err) {
                    //     $("terjadi error : "+ Status);

                    // }

                });
                return false;
            }

            // menampilkan list data nilai siswa 
            function tampil_data_nilai_siswa() {
                $.ajax({
                    url: "admin/proses.php",
                    type: "post",
                    data: {
                        'fetch': 'data_tabel_nilai_siswa'
                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(response) {
                        if (response.status) {
                            console.log(response.data);
                            // $('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');
                            $("#tabel_data_siswa tr:last").after(response.data);
                        } else {
                            console.log("false");
                        }
                    },
                    // error : function (xhr, Status, err) {
                    //     $("terjadi error : "+ Status);

                    // }

                });
                return false;
            }
            tampil_data_nilai_siswa();
            tampil_data_soal();
            tampil_data_kunci_jwbn();
            tampil_data_pilihan_ganda();
        <?php
    }
    /**end sessions an admin*/
    ?>

        <?php
        if (isset($ck_editor)) {
            ?>
            CKEDITOR.replace('editor1');
        <?php
    }
    ?>

    }); //end of document ready function
</script>

</body>

</html>