<?php
/**
 *  file untuk menjalankan query
 *  obj conn = return dari function connectDB()
*/
include "Koneksi.php";
class Query extends Koneksi{

	public function select_admin($var_username,$var_password){
		$q_select_admin = "SELECT * FROM master_admin_aplikasi WHERE username='".$var_username."' AND password='".$var_password."'";
		$res =[];
		$result = mysqli_query($this->conn,$q_select_admin);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}
	// select matpel join kelas
	public function select_matpel(){
		$query = "SELECT * FROM master_matpel mm LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}
	//select matpel where spesific kelas
	public function select_matpel_w_kelas($var_kelas){
		$query = "SELECT id_matpel,nama_matpel FROM master_matpel mm LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas WHERE mk.id_kelas=".$var_kelas;
		$res = NULL;
		// $res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			// $res[] = $row;
			$res .= "<option value='".$row['id_matpel']."'>".$row['nama_matpel']."</option>"; 
		}
		return $res;
	}
	//select nomor pertanyaan where spesific matpel and kelas
	public function select_no_pertanyaan_w_m_k($id_kelas,$id_matpel){
		$query = "SELECT * FROM tabel_soal ts LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel WHERE mm.kelas_id = $id_kelas AND ts.matpel_id = $id_matpel ";
		$res = NULL;
		// $res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			// $res[] = $row;
			$res .= "<option value='".$row['nomor_soal']."'>".$row['nomor_soal']."</option>"; 
		}
		return $res;
	}
	//select kelas
	public function select_kelas(){
		$query = "SELECT * FROM master_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}


	//insert matpel kelas
	public function insert_matpel($tablename,$insData){
		$columns = implode(", ",array_keys($insData));
        $rawvalues=array();
        foreach ($insData as $key => $value) {
            # code...
            $rawvalues[] = "\"".$value."\"";
        }
        $values  = implode(", ",$rawvalues);
        $query = "INSERT INTO `".$tablename."`($columns) VALUES (".$values.")";
		
		$execute = mysqli_query($this->conn,$query);
		return $execute;
	}
	public function close_db(){

		return mysqli_close($this->conn);
	}
}
$models = new Query();