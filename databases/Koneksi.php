<?php
/**
 *  file untuk koneksi database
 *  
*/
function Koneksi(){
    $conn;
    $host           = "localhost";
    $user           = "root";
    $password       = "1234563";
    $database_name  = "db_ujian_online";

    $conn = mysqli_connect($host,$user,$password,$database_name);
    if (mysqli_connect_errno()) {
        # code...
        return mysqli_connect_error();
    }else{
        return $conn;
    }
}

$anu = Koneksi();
var_dump($anu);