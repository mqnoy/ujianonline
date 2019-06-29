<!-- jQuery 3 --->
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

        $("#dashboard_menu").click(function () {
            window.location.href = "<?php echo base_url('dashboard.php'); ?>";
        })
        //combobox matpel sesuai dengan kelas
        $("#cb_matpel").hide();
        $("#cb_nomor_soal").hide();
        $("#group_pertanyaan").hide();
        $("#group_no_pertanyaan").hide();

        <?php
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && $_SESSION['is_siswa'] == true) {
            # code...
            ?>
            var url_static_siswa = "<?php echo base_url('includes/ajax.php'); ?>";
            

            //function copy token to clipboard
            $("#txt_token_siswa").click(function () {
                var token_value = $("#txt_token_siswa").val();
                $("#txt_token_siswa").select();
                document.execCommand("copy");
                alert("sudah di copy");
                //update database for hide token after clicked
            });
            
            //post lembar soal siswa 
            $("#btn_form_lembarsoal").click(function () {
                $.ajax({
                    url: url_static_siswa,
                    type: "post", 
                    data: $("#form_lembar_soal_siswa").serialize(),
                    dataType: "json", 
                    beforeSend: function() {
                        $("#btn_form_lembarsoal").prop('disabled', true);
                        $(".overlay").show();
                        $("#btn_form_lembarsoal").attr('class','btn btn-block btn-success disabled');
                        // $("#overlay").html("Please wait....");
                    },
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            $(".overlay").hide();
                            $("#notifications").fadeTo(1000, 500).slideUp(100, function(){
                                $("#notifications").slideUp(500);
                                window.location.href = "<?php echo base_url('dashboard.php?halaman=nilai_saya'); ?>";
                            });
                        } else {
                            alert("gagal post lembar soal!");

                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
                return false;
            })

            //terapkan token tuntuk melihat hasil nilai 1 siswa
            $("#send_nilai_toemail").click(function name(params) {
                var valueEmail =  $("#value_email").val();
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'aksi_siswa': 'kirim_email_nilai',
                        'set_email': valueEmail
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            alert("kirim email sukses " + response.pesan);
                            $(".overlay").hide();
                            // //console.log(response);
                        } else {
                            alert("kirim email gagal " + response.pesan);
                            $(".overlay").hide();
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("Terjadi error : " + Status);
                    }
                });
                return false;
                
            });

            //terapkan matpel siswa redirect ke halaman lembar soal
            $("#btn-modal-lsiswa-doit").click(function () {
                var soal_idmatpel =  $("#get_soal_idmatpel").text();
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'aksi_siswa': 'terapkan_matpel',
                        'set_matpel': soal_idmatpel
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            //console.log(response);
                            $(".overlay").hide();
                            window.location.href = "<?php echo base_url('dashboard.php?halaman=lembar_soal_siswa'); ?>";
                        } else {
                            console.log("set matpel gagal");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
                return false;
            });
            //fetch data soal untuk siswa
            function fetching_data_soal_list() {
                console.log("fetching data div");
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'data_listsoal_siswa',
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            var div_put;
                            var i = 1;
                            var data_soal_siswa_db = JSON.parse(JSON.stringify(response.data));
                            $.each(data_soal_siswa_db, function(index, item) {
                                $("#for_clone").clone().attr("id", "clone"+i+"").appendTo("#cloning");

                                $('#gg').hide();
                                $("#clone"+i+"").find("#put_soal_namamatpel").html(item.arr_matpel);
                                $("#clone"+i+"").find("#put_totaldata").html(item.arr_totaldata);
                                $("#clone"+i+"").find("#put_txtkelas").html(item.arr_kelas);
                                $("#clone"+i+"").find("#put_soal_idmatpel").html(item.arr_matpel_id);

                                $("#clone"+i+"").click(function () {
                                    $("#modal-list-soal-siswa").modal("show");
                                    $("#get_soal_idmatpel").text(item.arr_matpel_id);
                                });
                           
                            i++;
                            });
                            
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("Terjadi error : " + Status);
                    // }
                });
            }
            fetching_data_soal_list();
            

           
            //fetch data kelas untuk siswa
            function fetching_data_kelas_siswa() {
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'cb_data_kelas',
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
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
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
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

    if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && $_SESSION['is_admin'] == true) {
        ?>
        var url_static_admin = "<?php echo base_url('admin/ajax_admin.php'); ?>";

        //untuk pencarian nilai siswa
        $("#ns_btn").click(function () {
            var ns_keyword = $("#ns_itext").val();
            alert(ns_keyword);
        });
            //fetch data kelas untuk admin
            function fetching_data_kelas() {
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'cb_data_kelas',
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
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
                    url: url_static_admin,
                    data: {
                        'fetch': 'cr_nama_matpel',
                        idkelas: $("#cb_kelas").val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
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
                    url: url_static_admin,
                    data: {
                        'fetch': 'cr_nomor_soal',
                        idkelas: $("#cb_kelas").val(),
                        idmatpel: $("#cb_matpel").val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
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
                    url: url_static_admin,
                    data: {
                        'fetch': 'cr_txt_pertanyaan',
                        idkelas: $("#cb_kelas").val(),
                        idmatpel: $("#cb_matpel").val(),
                        nomorsoal: $("#cb_nomor_soal").val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
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
                            $(".overlay").hide();
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
                    url: url_static_admin,
                    type: "post", 
                    data: $("#form_matpel").serialize(),
                    dataType: "json", 
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            alert("berhasil tambah matpel");
                            fetch_data_mata_pelajaran();
                            // window.location.href = "<?php echo base_url('dashboard.php?halaman=form_mata_pelajaran'); ?>";
                        } else {
                            alert("gagal tambah matpel");
                            $(".overlay").hide();
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
                    url: url_static_admin,
                    type: "post", 
                    data: $("#form_pilihanganda").serialize(),
                    dataType: "json", 
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            alert("berhasil menambah pilihan ganda");
                            //coba w/o refresh
                            fetch_data_pilihan_ganda();
                            // $("#tabel_piihanganda").hide();
                            // $("#tabel_piihanganda").show();
                        } else {
                            alert("gagal menambah pilihan ganda");

                            window.setTimeout(function() {
                                $('#notifications').show();
                                $("#notifications").html(response.data);
                            }, 2000);
                            // $( '#notifications' ).attr( 'css', 'alert alert-success alert-dismissible' );   
                        }
                    },
                    error: function(xhr, Status, err) {
                        alert(Status);

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
                    url: url_static_admin,
                    type: "post", 
                    data: {
                        'fr_post_soal': $("[name='fr_post_soal']").val(),
                        'nm_kelas': $("#cb_kelas").val(),
                        'nm_matpel': $("#cb_matpel").val(),
                        'no_pertanyaan': $("#input_nomor_soal").val(),
                        'txt_pertanyaan': value.getData()
                    },
                    // 'form_data' : $("#form_soal").serialize() ,

                    dataType: "json", 
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            // console.log(response.data);
                            alert("berhasil tambah soal");
                            fetch_data_soal();
                            // window.location.href = "<?php echo base_url('dashboard.php?halaman=form_soal'); ?>";

                        } else {
                            alert("gagal tambah soal"); 
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("Terjadi error : " + Status);
                    }
                });
                return false;
            });

            function edit_data_mata_pelajaran(post_idmatpel,post_idkelas){
                $.ajax({
                    type: "post",
                    url: url_static,
                    data: {
                        'fetch': 'cb_data_kelas',
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            // console.log(response.data);
                            $(".mod-edit-mk").html(response.data).show();
                        } else {
                            console.log("data tidak ada");
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("Terjadi error : " + Status);
                    }
                });

                var kunci_jawaban = "";
                console.log(post_idmatpel,"&&",post_idkelas);
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'data_modal_mk',
                        'p_idmatpel' : post_idmatpel,
                        'p_idkelas' : post_idkelas
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            console.log(response);
                            $("#modal-edit-matpel [name='post_text_matpel']").val(response.text_matpel);
                            $("#modal-edit-matpel [name='post_matpel_id']").val(post_idmatpel);
                            $(".mod-edit-mk [value='"+post_idkelas+"']").attr('selected', 'selected');
                            $("#modal-edit-matpel").modal("show");
                            $("#modal-edit-matpel").on("hidden.bs.modal", function () {
                                // fix bug multi selected combo box
                                $("option:selected", ".mod-edit-mk").removeAttr("selected");
                                // alert("modal closed");
                            });
                            $(".overlay").hide();

                            
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
            //button edit mata pelajaran
            $("#btn-ubah-modal-mk").click(function () {
                $.ajax({
                    url: url_static_admin,
                    type: "post", 
                    data: $("#form_modal_mk").serialize(),
                    dataType: "json", 
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            $("#modal-edit-matpel").modal("hide");
                            $("#modal-edit-matpel").on("hidden.bs.modal", function () {
                                alert("berhasil ubah");
                                fetch_data_mata_pelajaran();
                            });
                        } else {
                            alert("gagal ubah");
                            $(".overlay").hide();
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("Terjadi error : " + Status);
                    }
                });
                return false;

            });

            function fetch_data_modal_mkj(post_idsoal){
                var kunci_jawaban = "";
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'data_modal_mkj',
                        'p_idsoal' : post_idsoal
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            console.log(response);
                            $("#modal-kunci-jawaban #modal-mkj-text-soal").text(response.text_soal_modal);
                            $("#modal-kunci-jawaban #modal-mkj-pilihan-ganda").html(response.data_pg_modal);
                            $("#modal-kunci-jawaban [name='post_soal_id']").val(post_idsoal);
                            $("#modal-kunci-jawaban [name='post_pg_bobot']").val(response.data_bobotjwbn_modal);
                            $("#modal-kunci-jawaban [value='"+response.data_kuncijwbn_modal+"']").attr('checked', 'checked');
                            $(".overlay").hide();
                            $("#modal-kunci-jawaban").modal("show");

                            $("#btn-pilih-modal-mkj").click(function () {
                                $.ajax({
                                    url: url_static_admin,
                                    type: "post", 
                                    data: $("#form_modal_mkj").serialize(),
                                    dataType: "json", 
                                    beforeSend: function() {
                                        $(".overlay").show();
                                    },
                                    success: function(response) {
                                        if (response.status) {
                                            $("#modal-kunci-jawaban").modal("hide");
                                            $(".overlay").hide();
                                            alert("success");
                                            fetch_data_kunci_jwbn();
                                            // window.location.href = "<?php echo base_url('dashboard.php?halaman=master_kunci_jawaban'); ?>";
                                        } else {
                                            alert("gagal menerapkan kunci jawaban");
                                        }
                                    },
                                    // error: function(xhr, Status, err) {
                                    //     $("Terjadi error : " + Status);
                                    // }
                                });
                                return false;

                            });

                            
                        } else {
                            console.log("false");
                        }
                    },
                    // error: function(xhr, Status, err) {
                    //     $("terjadi error : " + Status);

                    // }

                });

                return false;
            } 
            
            //hapus satu mata pelajaran
            $("#modal-remove-matpel .btn-hpus-matpel").click(function () {
                var id_matpel = $("#modal-remove-matpel [name='text_matpel']").val();
                console.log("do hapus",id_matpel);

                $.ajax({
                    url: url_static_admin,
                    type: "post", 
                    data: $("#form_del_modal_mk").serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            alert("berhasil hapus");
                            $(".overlay").hide();
                            $("#modal-remove-matpel").modal("hide");
                            fetch_data_mata_pelajaran();
                            // window.location.href = "<?php echo base_url('dashboard.php?halaman=form_mata_pelajaran'); ?>";
                                        
                        } else {
                            alert("gagal hapus");
                        }
                    },
                    error: function(xhr, Status, err) {
                        $("terjadi error : " + Status);

                    }

                });
                return false;
            });

            // menampilkan list data untuk data mata pelajaran 
            function fetch_data_mata_pelajaran() {
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'list_matpel'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            
                            $("#tabel_matpel > tbody").empty().append(response.data);
                            $(".overlay").hide();
                            //button master matpel untuk update 
                            var db_list_kuncijawaban = JSON.parse(JSON.stringify(response.data));
                            $(".btn_aksi_mp .edit-matpel").each(function (index , obj) {
                                $(this).click(function () {
                                    //data-soal='1' data-matpel= '15'
                                    var id_matpel_db =$(this).data('matpel');
                                    var id_kelas_db =$(this).data('kelas');
                                    edit_data_mata_pelajaran(id_matpel_db,id_kelas_db);
                                });
                            });
                            $(".btn_aksi_mp .remove-matpel").each(function (index , obj) {
                                $(this).click(function () {
                                    //data-soal='1' data-matpel= '15'
                                    var id_matpel_db =$(this).data('matpel');
                                    var id_kelas_db =$(this).data('kelas');
                                    $("#modal-remove-matpel [name='text_matpel']").val(id_matpel_db);
                                    $("#modal-remove-matpel [name='text_kelas']").val(id_kelas_db);
                                    $("#modal-remove-matpel").modal("show");
                                });
                            });
                            
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

            // menampilkan list data untuk data kunci jawaban 
            function fetch_data_kunci_jwbn() {
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'tam_kunci_jawaban'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".overlay").hide();
                            // console.log(response.data);
                            $("#tabel_kunci_jawaban > tbody").empty().append(response.data);

                            //button master kunci jawaban untuk update 
                            var db_list_kuncijawaban = JSON.parse(JSON.stringify(response.data));
                            $(".btn_aksi_mkj button").each(function (index , obj) {
                                $(this).click(function () {
                                    //data-soal='1' data-matpel= '15'
                                    var idsoal_source =$(this).data('soal');
                                    fetch_data_modal_mkj(idsoal_source);
                                    console.log(idsoal_source);
                                });
                            });
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
            function fetch_data_pilihan_ganda() {
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'tam_pilihan_ganda'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $("#tabel_piihanganda > tbody").empty().append(response.data);
                            $(".overlay").hide();

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
            function fetch_data_soal() {
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'data_tabel_soal'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            // console.log(response.data);
                            $("#tabel_soal > tbody").empty().append(response.data);
                            
                        } else {
                            console.log("false tabel_soal");
                        }
                    },
                    // error : function (xhr, Status, err) {
                    //     $("terjadi error : "+ Status);

                    // }

                });
                return false;
            }

            // menampilkan list data nilai siswa 
            function fetch_data_nilai_siswa() {
                $.ajax({
                    url: url_static_admin,
                    type: "post",
                    data: {
                        'fetch': 'data_tabel_nilai_siswa'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".overlay").show();
                    },
                    success: function(response) {
                        if (response.status) {
                            $("#tabel_data_siswa > tbody").empty().append(response.data);
                            
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
            fetch_data_nilai_siswa();
            fetch_data_soal();
            fetch_data_mata_pelajaran();
            fetch_data_kunci_jwbn();
            fetch_data_pilihan_ganda();
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
<script>

$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
    EnableRemember: true,
    NoTransitionAfterReload: false
    //Removes the transition after page reload.
};

$(function () {
    "use strict";

    $("body").on("collapsed.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=closed";
        } 
    });
    $("body").on("expanded.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=opened";
        } 
    });

    if($.AdminLTESidebarTweak.options.EnableRemember){
        var re = new RegExp('toggleState' + "=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if(toggleState == 'closed'){
            if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function(){
                    $(this).removeClass('hold-transition'); 
                });
            }else{
                $("body").addClass('sidebar-collapse');
            }
        }
    } 
});
</script>

</body>

</html>