<?php
/**
 *  file untuk koneksi database
 *
 */
include "settings.php";
class Koneksi{
    public $conn;

    public function __construct() {
        $this->connectDB();
    }
    protected function connectDB(){

        $this->conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            # code...
            return mysqli_connect_error();
        } else {
            return $this->conn;
        }
    }
}
