<?php
session_start();
include '../includes/Query.php';

if (isset($_SESSION['is_logged'])) {
    # code...
    
    //post lembar soal siswa
    if (isset($_POST['fr_post']) && $_POST['fr_post'] == "post_lembarsoal_siswa") {
        # code...
        $status = false;
        $data="";
        $nilai = 0; 
        if (isset($_POST['pilihan'])) {
            # code...
            $jawaban_siswa = $_POST['pilihan'];

            foreach ($jawaban_siswa as $soalid => $jawaban) {
                # code...
                $kunci_jawaban = $models->select_kunci_jawaban_sis($soalid);
                $periksa_jawaban = periksa_jawaban($jawaban,$kunci_jawaban['jawaban_pg']);
                if ($periksa_jawaban) {
                    # code...
                    $nilai += $kunci_jawaban['bobot'];
                }
            }

            $nama_siswa = $_SESSION['ses_nama_siswa'];
            $nis_siswa = $_SESSION['ses_nis_siswa'];
            $matpelid = $_SESSION['ses_id_matpel'];
            $siswakelas =  $_SESSION['ses_kelas_soal'];
            $id_siswa = 0;
            $select_siswa = $models->select_from("master_siswa","siswa_nis","=",$nis_siswa);
            foreach ($select_siswa as $value_siswa) {
                # code...
                $id_siswa = $value_siswa['id_siswa'];
            }
            $insData = array (
                'siswa_id' => $id_siswa ,
                'total_nilai' => $nilai ,
                'matpel_id' => $matpelid,
                'tanggal_pengerjaan' => tgl_waktu_skrg()
            );
            $insert_nilaisiswa = $models->insert_into("tabel_nilai_siswa",$insData);
            if ($insert_nilaisiswa) {
                # code...
                $data=  "nilai hasilnya = ".$nilai;
                $status = true;
                $response = array(
                    'status' => $status,
                    'data' => $data
                );
            }
        }else{
            $data=  "tidak boleh ada yg kosong !";
            $response = array(
                'status' => $status,
                'data' => $data
            );

        }
        echo json_encode($response);
    }

    //global used post data kelas
    if (isset($_POST['fetch']) && $_POST['fetch'] =="cb_data_kelas" ) {
        # code...
        $data_kelas = $models->select_kelas();
        if ($data_kelas == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $response = array(
                'status' => true,
                'data' => $data_kelas
            );
        }
        echo json_encode($response);
    }
    //terapkan token tuntuk melihat hasil nilai 1 siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "terapkan_token_siswa") {
        $set_token = $_POST['set_token'];

        $_SESSION['token_siswa'] = $set_token;
        $gettoken = $_SESSION['token_siswa'];

            $response = array(
                'status' => true,
                'pesan' => "token diset"
            );

        echo json_encode($response);
    }

    //pemilihan kelas di list soal siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "terapkan_kelas") {
        $set_kelas = $_POST['set_kelas'];

        $_SESSION['ses_kelas_soal'] = $set_kelas;
        $getkelas = $_SESSION['ses_kelas_soal'];

        $nis_siswa = $_SESSION['ses_nis_siswa'];
        //update siswa kelas
        $update_siswa = $models->update_siswa($getkelas,$nis_siswa);
        if ($update_siswa) {
            # code...
            $response = array(
                'status' => true,
                'kelas_yg_dipilih' => $getkelas
            );
        }else{
            $response = array(
                'status' => false,
                'pesan' => "gagal menerapkan kelas"
            );
        }

        echo json_encode($response);
    }
    //pemilihan matpel di list soal siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] =="terapkan_matpel" ) {
        # code...
        $set_matpel = $_POST['set_matpel'];

        $_SESSION['ses_id_matpel'] = $set_matpel;

        $get_idmatpel = $_SESSION['ses_id_matpel'];
        $response = array(
            'status' => true,
            'matpel_yg_dipilih' => $get_idmatpel
        );
        
        echo json_encode($response);
    }

    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_listsoal_siswa") {
        # code...
        $getsoal_session = isset($_SESSION['ses_kelas_soal']) ? $_SESSION['ses_kelas_soal'] : false ;
        $data_matpel_siswa = $models->select_matpel_kelas($getsoal_session);
        $total_soal = [];
        $data_div = [];
        if ($data_matpel_siswa == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            foreach ($data_matpel_siswa as $value) {
                # code...
                $i = 0;
                $total_soal = $models->select_count("tabel_soal", "matpel_id", "=", $value['id_matpel']);
                $data_div[] = [
                    "arr_matpel" => $value['nama_matpel'],
                    "arr_totaldata" => $total_soal[$i]['total_data'],
                    "arr_kelas" => $value['txt_kelas'],
                    "arr_matpel_id" => $value['id_matpel']
                ];
            $i++;
            }
            $response = array(
                'status' => true,
                'data' => $data_div
            );
        }
        echo json_encode($response);
    }
}