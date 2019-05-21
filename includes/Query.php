<?php
/**
 *  file untuk menjalankan query
 * 
*/
require "Koneksi.php";
$conn = connectDB();

function select_soal($query){
    $conn = connectDB();
    $executeQuery = mysqli_query($conn,$query);
    $result = mysqli_fetch_array($executeQuery);
    return $executeQuery;
}
function select_admin($var_username,$var_password){
	$conn = connectDB();
	$q_select_admin = "SELECT * FROM master_admin_aplikasi WHERE username='".$var_username."' AND password='".$var_password."'";
	// $q_select_admin = "SELECT * FROM master_admin_aplikasi";
	
	$res =[];
	$result = mysqli_query($conn,$q_select_admin);
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$res[] = $row;
	}
	return sizeof($res) > 0 ? $res : null;
}
// $select = select_admin("admin",MD5("admin"));
// // $conn = $anu->connectDB();
// foreach ($select as $key => $value) {
// 	# code...
// 	var_dump($value);

// }