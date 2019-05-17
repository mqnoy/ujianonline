<?php
session_start();
$response = array();
$_SESSION['lembar_soal'] = array();
$response['save_jawaban'] = false;
# code...
array_push($_SESSION['lembar_soal'] ,$_POST['pilihannya']);
$response['status'] = true;
$response['nomor_soal'] = $_POST['soal_nomor'];
$response['jawaban'] = $_POST['pilihan'];
if ($_SESSION['lembar_soal'] != NULL) {
    # code...
    $response['save_jawaban'] = true;
}
echo json_encode($response);

?>