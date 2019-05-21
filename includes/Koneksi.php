<?php
/**
 *  file untuk koneksi database
 *
 */
function connectDB(){
    $conn;
    $host = "localhost";
    $user = "root";
    $password = "123456";
    $database_name = "db_ujianonline";

    $conn = mysqli_connect($host, $user, $password, $database_name);
    if (mysqli_connect_errno()) {
        # code...
        return mysqli_connect_error();
    } else {
        return $conn;
    }
}
