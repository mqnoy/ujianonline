<?php
$response = array();
$response['status'] = true;
$response['semua_jawaban'] = $_POST['pilihan'];
echo json_encode($response);
?>