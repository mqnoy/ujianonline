<?php
session_start();
include '../includes/Query.php';

if (isset($_SESSION['is_logged']) && $_SESSION['is_admin'] == true) {
    # code...

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
}

if (isset($_POST['idkelas'])) {
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
if (isset($_POST['tampil'])) {
    # code...
    $id_kelas = $_POST['idkelas'];
    $id_matpel = $_POST['idmatpel'];
    $data_nomor_soal = $models->select_no_pertanyaan_w_m_k($id_kelas, $id_matpel);
    $response = array(
        'status' => true,
        'data_nomor_soal' => $data_nomor_soal
    );

    // $response22 = array(
    //     'status'=> true,
    //     'anuan' => $_POST
    // );

    echo json_encode($response);
}
