<?php
session_start();
include '../includes/Query.php';

if (isset($_SESSION['is_logged']) && $_SESSION['is_admin'] == true) {
    # code...

    //post matapelajaran
    if (isset($_POST['fr_post_matpel'])) {
        # code...
        $status = false;
        if (empty($_POST['nm_matpel'])) {
            # code...
            $response = array(
                'status' => false,
                'data' => "nama mata pelajaran tidak boleh kosong !"
            );
        } else if ($_POST['matpel_kelas'] == null || $_POST['matpel_kelas'] == 0) {
            $response = array(
                'status' => false,
                'data' => "kelas harus di pilih !"
            );
        } else {
            $data = array(
                'nama_matpel' => $_POST['nm_matpel'],
                'kelas_id' => $_POST['matpel_kelas']
            );
            $insert_matpel = $models->insert_matpel("master_matpel", $data);
            if ($insert_matpel) {
                # code...
                $data = "matpel berhasil di tambah";
                $status = true;
            }
            $response = array(
                'status' => $status,
                'data' => $data
            );
        }
        echo json_encode($response);
    }

    //post matapelajaran
    if (isset($_POST['fr_post_pilihanganda'])) {
        # code...
        $soal_id = $_POST['soalid'];
        $pg_soal = $_POST['pg_soal'];
        $data = [];
        $abjad_pilihan = array("A", "B", "C", "D");
        foreach ($pg_soal as $key => $value) {
            # code...
            $data[$key] = array(
                'soal_id' => $soal_id,
                'jawaban_pg' => $abjad_pilihan[$key],
                'jawaban_text' => $pg_soal[$key]
            );
            $insert_pg_soal[$key] = $models->insert_pg_soal("master_pg_soal", $data[$key]);

            if ($insert_pg_soal[$key]) {
                # code...
                $response = array(
                    'status' => true,
                    'data' => "pilihan ganda berhasil di tambah"
                );
            }
        }
        echo json_encode($response);
    }

    //post soal
    if (isset($_POST['fr_post_soal'])) {
        # code...
        // $message =  htmlentities($_POST);

        $status = false;
        if (empty($_POST['txt_pertanyaan'])) {
            # code...
            $response = array(
                'status' => false,
                'data' => "pertanyaan tidak boleh kosong !"
            );
        } else if ($_POST['nm_matpel'] == null || $_POST['nm_matpel'] == 0) {
            $response = array(
                'status' => false,
                'data' => "mata pelajaran harus di pilih !"
            );
        } else {
            $data = array(
                'nomor_soal' => $_POST['no_pertanyaan'],
                'text_soal' => $_POST['txt_pertanyaan'],
                'matpel_id' => $_POST['nm_matpel']
            );
            $insert_matpel = $models->insert_into("tabel_soal", $data);
            if ($insert_matpel) {
                # code...
                $data = "soal baru berhasil di tambah";
                $status = true;
            }
            $response = array(
                'status' => $status,
                'data' => $data
            );
        }
        echo json_encode($response);
    }
    //post master kunci jawaban mkj
    if (isset($_POST['fr_post_masterkuncijwbn'])) {
        # code...
        $status = false;
        $pesan = null;
        $soal_id = $_POST['post_soal_id'];
        $bobot_pg = empty($_POST['post_pg_bobot']) ? 0 : $_POST['post_pg_bobot'] ;
        if (isset($_POST['pilihan_ganda'])) {
            # code...
            $pilihan_ganda = $_POST['pilihan_ganda'];
            $value_pg = "";
            foreach ($pilihan_ganda as $key => $val_pilihan_ganda) {
                # code...
                $value_pg = $pilihan_ganda[$key];
            }
            $check_kuncijwbn = $models->select_from("master_kunci_jawaban","soal_id","=",$soal_id);
            if ($check_kuncijwbn) {
                # code...
                //do update
                $update_kuncijwb = $models->update_kunci_jawaban($soal_id,$value_pg,$bobot_pg);
                if ($update_kuncijwb) {
                    # code...
                    $status = true;
                    $pesan = "perubahan kunci jawaban sukses";
                }else{
                    $status = false;
                    $pesan = "perubahan kunci jawaban gagal";
                }
                
            }else{
                //do insert
                $data_kuncijawaban = array(
                    'soal_id' => $soal_id,
                    'jawaban_pg' => $value_pg,
                    'bobot' => $bobot_pg 
                );
                $insert_kuncijwbn = $models->insert_into("master_kunci_jawaban",$data_kuncijawaban);
                // var_dump($insert_kuncijwbn);
                if ($insert_kuncijwbn) {
                    # code...
                    $status = true;
                    $pesan = "tambah kunci jawaban sukses";
                }
            }
        }
        $response = array(
            'status' => $status,
            'pesan' => $pesan
        );
        
        echo json_encode($response);

    }
    //cari nama matpel
    if (isset($_POST['fetch']) && $_POST['fetch'] == "cr_nama_matpel") {
        # code...
        if ($_POST['idkelas'] == 0) {
            # code...
            $response = array(
                'status' => true,
                'data' => "belum dipilih"
            );
        } else {
            $id_kelas = $_POST['idkelas'];
            $data_matpel = $models->select_matpel_w_kelas($id_kelas);
            if ($data_matpel == null) {
                # code...
                $response = array(
                    'status' => false,
                    'data' => $data_matpel
                );
            } else {
                $response = array(
                    'status' => true,
                    'data' => $data_matpel
                );
            }
        }
        echo json_encode($response);
    }
    //cari no soal
    if (isset($_POST['fetch']) && $_POST['fetch'] == "cr_nomor_soal") {
        # code...
        $id_kelas = $_POST['idkelas'];
        $id_matpel = $_POST['idmatpel'];
        $data_nomor_soal = $models->select_no_pertanyaan_w_m_k($id_kelas, $id_matpel);
        if ($data_nomor_soal == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $response = array(
                'status' => true,
                'data' => $data_nomor_soal
            );
        }
        echo json_encode($response);
    }
    //cari pertanyaan
    if (isset($_POST['fetch']) && $_POST['fetch'] == "cr_txt_pertanyaan") {
        # code...
        $id_kelas = $_POST['idkelas'];
        $id_matpel = $_POST['idmatpel'];
        $nomor_soal = $_POST['nomorsoal'];
        $data_soal = $models->select_txt_pertanyaan_w_m_k($id_kelas, $id_matpel, $nomor_soal);
        if ($data_soal == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $data = null;
            foreach ($data_soal as $value) {
                # code...
                $data = $value;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        echo json_encode($response);
    }
    //data modal master mata pelajaran
    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_modal_mk") {
        # code...
        $id_matpel = $_POST['p_idmatpel'];
        $id_kelas = $_POST['p_idkelas'];
        $list_matpel = $models->select_matpel($id_matpel,$id_kelas);
        // var_dump($list_matpel);
        $status = false;
        $text_matpel="";
        $text_kelas="";
        if ($list_matpel != null) {
            # code...
            $status = true;
            foreach ($list_matpel as $val_matpel) {
                # code...
                $text_matpel = $val_matpel['nama_matpel'];
                $text_kelas = $val_matpel['txt_kelas'];
            }
            $response = array(
                'status' => $status,
                'text_matpel' => $text_matpel,
                'text_kelas' => $text_kelas,
            );
        }else{
            $response = array(
                'status' => $status,
                'data' => "tidak ada!",
            );
        }
        //  var_dump($response);
         echo json_encode($response);
    }
    //edit mata pelajaran
    if (isset($_POST['fr_post_mastermatpel']) && $_POST['fr_post_mastermatpel']=="post_mk") {
        # code...
        // var_dump($_POST);
        $val_id_matpel = $_POST['post_matpel_id'];
        $val_text_matpel = $_POST['post_text_matpel'];
        $val_kelas_id = $_POST['matpel_kelas'];
        $edit_matpel = $models->update_matpel($val_text_matpel,$val_id_matpel,$val_kelas_id);
        if ($edit_matpel) {
            # code...
            $status = true;
            $pesan = "berhasil ubah mata pelajaran";
        }else{
             $status = false;
             $pesan = "gagal ubah mata pelajaran";
        }
        $response = array(
            "status" => $status,
            "pesan" => $pesan
        );
        // var_dump($edit_matpel);
        echo json_encode($response);
    }
    //delete satu mata pelajaran
    if (isset($_POST['fr_post_del']) && $_POST['fr_post_del'] == "post_del_matpel") {
        # code...
        // var_dump($_POST);
        $id_matpel = $_POST['text_matpel'];
        //($tablename,$field,$operand,$priKey)
        $delete_matpel = $models->delete_one_record("master_matpel","id_matpel","=",$id_matpel);
        $status = false;
        if ($delete_matpel) {
            # code...
            $status = true;
            $pesan = "berhasil hapus mata pelajaran";
        }else{
             $status = false;
             $pesan = "gagal hapus mata pelajaran";
        }
        $response = array(
            "status" => $status,
            "pesan" => $pesan
        );
        echo json_encode($response);
    }

    //data modal master kunci jawaban mkj
    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_modal_mkj") {
        # code...
        $data_pg_modal=[];
        $id_soal = $_POST['p_idsoal'];
        $soal_untuk_siswa  = $models->select_soal("id_soal","=",$id_soal);
        $kunci_jawaban = $models->select_kunci_jawaban("id_soal","=",$id_soal);
        $kunci_jawaban_db = "";
        $bobot_jawaban_db = "";
        foreach ($kunci_jawaban as $val_kunci_jawaban) {
            # code...
            $kunci_jawaban_db = $val_kunci_jawaban['jawaban_pg'];
            $bobot_jawaban_db = $val_kunci_jawaban['bobot'];
        }

        foreach ($soal_untuk_siswa as $soal) {
            $no_soal = $soal['nomor_soal'];
            $text_soal_modal = strip_tags($soal['text_soal']);
            $list_pilihan_ganda_soal = $models->select_pgsoal_siswa($soal['id_soal']);
            if ($list_pilihan_ganda_soal != null) {
                foreach ($list_pilihan_ganda_soal as $pilihan_ganda) {
                    $value_pg = $pilihan_ganda['jawaban_pg'];
                    $text_pg = $pilihan_ganda['pilihan_ganda'];
                    $data_pg_modal []= "
                    <div class='input-group'>
                        <div class='radio'>
                            <label>
                                <input type='radio' id='pilihan_ganda' name='pilihan_ganda[$id_soal]' value='$value_pg'>$text_pg
                            </label>
                        </div>
                    </div>
                    ";
                }
            }

        }
        $response = array(
            'status' => true,
            'text_soal_modal' => $text_soal_modal,
            'data_pg_modal' => $data_pg_modal,
            'data_kuncijwbn_modal' => $kunci_jawaban_db,
            'data_bobotjwbn_modal' => $bobot_jawaban_db
        );
        //  var_dump($response);
         echo json_encode($response);

    }
        //data tabel mata pelajaran
        if (isset($_POST['fetch']) && $_POST['fetch'] == "list_matpel") {
            # code...
            /** 
    ["id_matpel"]=>
    string(2) "16"
    ["nama_matpel"]=>
    string(7) "english"
    ["kelas_id"]=>
    string(1) "2"
    ["id_kelas"]=>
    string(1) "2"
    ["txt_kelas"]=>
    string(11) "kelas 2 smk"
    ["kelas"]=>
    string(1) "2"
  } */
            $list_matpel = $models->select_matpel();
            if ($list_matpel == null) {
                # code...
                $response = array(
                    'status' => true,
                    'data' => "tidak ada data"
                );
            }else{
                $data = [];
                $nomor=1;
                $i=0;

                // ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mm.nama_matpel,mk.txt_kelas
                foreach ($list_matpel as $value) {
                    # code...
                    $id_matpel = $value['id_matpel'];
                    $id_kelas = $value['id_kelas'];
                    $data []="
                    <tr>
                        <td>".$nomor."</td>
                        <td>".$value['txt_kelas']."</td>
                        <td>".$value['nama_matpel']."</td>
                        <td>
                            <div class='btn-group margin btn_aksi_mp'>
                                <button role='button' data-matpel='".$id_matpel."' data-kelas= '".$id_kelas."' type='button' class='edit-matpel btn  btn-warning'><i class='fa fa-edit'></i></button>
                                <button role='button' data-matpel='".$id_matpel."' data-kelas= '".$id_kelas."' type='button' class='remove-matpel btn  btn-danger'><i class='fa fa-remove'></i></button>
                            </div>
                        </td>
                        </tr>
                    ";
                    $i++;
                    $nomor++;
                }
                $response = array(
                    'status' => true,
                    'data' => $data
                );
            }
            // var_dump($data);
            echo json_encode($response);
        }
    //data tabel kunci jawaban
    if (isset($_POST['fetch']) && $_POST['fetch'] == "tam_kunci_jawaban") {
        # code...
        $data_soal_kunci_jawaban = $models->select_kunci_jawaban();
        if ($data_soal_kunci_jawaban == null) {
            # code...
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        }else{
            $data = [];
            $nomor=1;
            $i=0;
            // ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mm.nama_matpel,mk.txt_kelas
            foreach ($data_soal_kunci_jawaban as $value) {
                # code...
                $jawaban_pg = $value['jawaban_pg'] == null ? "belum di set" : $value['jawaban_pg'] ;
                $bobot= $value['bobot'] == null ? 0 : $value['bobot'] ;
                $id_soal = $value['id_soal'];
                $matpel_id = $value['matpel_id'];
                $data []= "
                <tr>
                    <td>".$nomor."</td>
                    <td>".$value['nomor_soal']."</td>
                    <td>".strip_tags($value['text_soal'])."</td>
                    <td>".$jawaban_pg."</td>
                    <td>".$bobot."</td>
                    <td>".$value['nama_matpel']."</td>
                    <td>".$value['txt_kelas']."</td>
                    <td>
                        <div class='btn-group margin btn_aksi_mkj' id='btn_aksi_mkj_group'>
                            <button role='button' data-soal='".$id_soal."' data-matpel= '".$matpel_id."' data-jawabanpg= '".$value['jawaban_pg']."' data-bobotpg= '".$value['bobot']."' type='button' class='btn  btn-warning'><i class='fa fa-edit'></i></button>
                        </div>
                    </td>
                    </tr>
                ";
                $i++;
                $nomor++;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        // var_dump($data);
        echo json_encode($response);
    }
    //data table pilihan ganda
    if (isset($_POST['fetch']) && $_POST['fetch'] == "tam_pilihan_ganda") {
        # code...
        $data_pilihan_ganda = $models->select_pilihan_ganda();
        if ($data_pilihan_ganda == null) {
            # code...
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        }else{
            $data = [];
            $nomor=1;
            // ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mm.nama_matpel,mk.txt_kelas
            foreach ($data_pilihan_ganda as $value) {
                # code...
                // $jawaban_pg = $value['jawaban_pg'] == null ? "belum di set" : $value['jawaban_pg'] ;
                $data []= "
                <tr>
                    <td>".$nomor."</td>
                    <td>".$value['nomor_soal']."</td>
                    <td>".strip_tags($value['text_soal'])."</td>
                    <td>".$value['pilihan_ganda']."</td>
                    <td>".$value['nama_matpel']."</td>
                    <td>".$value['txt_kelas']."</td>
                    <td>
                        <div class='btn-group'>
                            <a class='margin' data-toggle='modal' data-target='#modal-pilihan-ganda'>
                                <button type='button' class='btn  btn-warning'><i class='fa fa-edit'></i></button>
                            </a>
                        </div>
                    </td>
                    </tr>
                ";
                $nomor++;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        echo json_encode($response);
    }

    //data tabel soal
    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_tabel_soal") {
        # code...
        $data_soal = $models->select_soal();
        if ($data_soal == null) {
            # code...
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        }else{
            $data = [];
            $nomor=1;
            // ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mm.nama_matpel,mk.txt_kelas
            foreach ($data_soal as $value) {
                # code...
                $data []= "
                <tr>
                    <td>".$nomor."</td>
                    <td>".$value['nomor_soal']."</td>
                    <td>".strip_tags($value['text_soal'])."</td>
                    <td>".$value['nama_matpel']."</td>
                    <td>".$value['txt_kelas']."</td>
                    <td>
                        <div class='btn-group'>
                            <a class='margin' data-toggle='modal' data-target='#modal-soal'>
                                <button type='button' class='btn  btn-warning'><i class='fa fa-edit'></i></button>
                            </a>
                        </div>
                    </td>
                    </tr>
                ";
                $nomor++;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        // var_dump($data);
        echo json_encode($response);
    }

    //data tabel nilai siswa
    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_tabel_nilai_siswa") {
        # code...
        $data_nilai_siswa = $models->select_nilai_siswa();
        if ($data_nilai_siswa == null) {
            # code...
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        }else{
            $data = [];
            $nomor=1;
            /*
            success
            warning
            primary
            danger */
            foreach ($data_nilai_siswa as $value) {
                # code...
                $total_nilai = $value['total_nilai'];
                $warna_nilai="";
                if ($total_nilai > 80) {
                    # code...
                    $warna_nilai = "primary";
                }else if($total_nilai <= 80 && $total_nilai >70){
                    $warna_nilai = "success";
                }else if($total_nilai <= 70 && $total_nilai >60){
                    $warna_nilai = "warning";
                }else{
                    $warna_nilai = "danger";
                }
                $data []= "
                <tr>
                    <td>".$nomor."</td>
                    <td>".$value['siswa_nis']."</td>
                    <td>".$value['siswa_nama']."</td>
                    <td>".$value['txt_kelas']."</td>
                    <td>".$value['nama_matpel']."</td>
                    <td><span class='label label-".$warna_nilai."'>$total_nilai</span></td>
                    <td>".$value['tanggal_pengerjaan']."</td>
                </tr>
                ";
                $nomor++;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        // var_dump($data);
        echo json_encode($response);
    }


}/**end sessions */
