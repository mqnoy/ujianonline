<?php
session_start();
$response = array();
$_SESSION['lembar_soal'] = array();

if (isset($_POST['val_name'])) {
    # code...
    array_push($_SESSION['lembar_soal'] ,$_POST['val_name']);
    $response['status'] = true;
    $response['msg'] ='udah ke submit'.$_POST['val_name'];
    $response['name_pilihan'] = $_SESSION['lembar_soal'];
    echo json_encode($response);
}
?>