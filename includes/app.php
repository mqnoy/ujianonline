<?php
define("_DIR_APPS_","ujianonline");

function base_url($SCRIPT_NAME=null){

    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
    $arr = array($uri,_DIR_APPS_,$SCRIPT_NAME);
    $glue = "/";
    $base_url = implode($glue,$arr); 

    return $base_url;
}

//fungsi untuk mencocokan jawaban siswa dengan kunci jawaban di database
function periksa_jawaban($jawaban,$kunci_jawaban){
    $ret = false;
    if ($jawaban === $kunci_jawaban) {
        # code...
        $ret = true;
    }
    return $ret;
}

//fungsi untuk generate token siswa diperlukan ketika melihat hasil nilai
function generate_tokenSiswa($string){
    $acak = str_shuffle("1234ABCDEFGH");
    $raw = $string.$acak;
    $generate_token = base64_encode($raw);
    return $generate_token;
}

//fungsi untuk mengambill tanggal sekarang 
function tgl_waktu_skrg(){
    return date("Y-m-d H:i:s");
}


$hal_aktif = function ($str_halaman){
    // unset($_SESSION['halaman_aktif']);
    // $_SESSION['halaman_aktif'] = $str_halaman;
    return $_SESSION['halaman_aktif'] = $str_halaman;

};