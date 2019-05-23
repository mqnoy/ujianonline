<?php
$getConn;
function koneksi(){
    $host = "localhost";
    $username ="root";
    $password ="123456";
    $dbname ="db_ujianonline";

    $conn = mysqli_connect($host,$username,$password,$dbname);
    if ($conn) {
        # code...
        return $conn;
    }else {
        # code...
        return mysqli_connect_error();
    }
}

/**
 * void 
 * 
 */
function select_semuaPertanyaan(){
    $link = koneksi();
    $data=array();
    $query = "SELECT * FROM master_pertanyaan";
    $res = mysqli_query($link,$query) or die("error query");
        while( $row = mysqli_fetch_assoc($res) ) { 
            $data[] = $row;
        }
  
    return $data;
}
/**
 * @param id_petanyaan
 * 
 */
function select_listJawaban($id_petanyaan){
    $link = koneksi();
    $data=array();
    $query = "SELECT * FROM master_jawaban WHERE pertanyaan_id = ".$id_petanyaan;
    $res = mysqli_query($link,$query) or die("error query") ;
        # code...
        while($row = mysqli_fetch_assoc($res)) { 
            $data[] = $row;
        }
    return $data;
}
?>