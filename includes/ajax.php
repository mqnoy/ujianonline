<?php
session_start();
include '../includes/Query.php';

if (isset($_SESSION['is_logged'])) {
    # code...
    //post data kelas
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
    //pemilihan kelas di list soal siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "terapkan_kelas") {
        $set_kelas = $_POST['set_kelas'];

        $_SESSION['get_kelas'] = $set_kelas;

        $getkelas = $_SESSION['get_kelas'];
        $response = array(
            'status' => true,
            'kelas_yg_dipilih' => $getkelas
        );
        
        echo json_encode($response);
    }

    if (isset($_POST['fetch']) && $_POST['fetch']== "data_listsoal_siswa") {
        # code...
        $getsoal_session = isset($_SESSION['get_kelas']) ? $_SESSION['get_kelas'] : false ;
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
                    "arr_kelas" => $value['txt_kelas']
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