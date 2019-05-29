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
}