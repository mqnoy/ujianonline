<?php
session_start();
$response = array();
$_SESSION['jawaban_peserta'] = array();
$response['save_jawaban'] = false;
# code...
array_push($_SESSION['jawaban_peserta'] ,$_POST['pilihan']);
$response['status'] = true;
$response['nomor_soal'] = $_POST['soal_nomor'];
$response['jawaban'] = $_POST['pilihan'];
if ($_SESSION['jawaban_peserta'] != NULL) {
    # code...
    $response['save_jawaban'] = true;
}
var_dump($_SESSION);

//echo json_encode($response);

?>