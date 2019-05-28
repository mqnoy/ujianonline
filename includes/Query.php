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
		$res = "<option value=\"0\">pilih mata pelajaran</option>";

		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			// $res[] = $row;
			$res .= "<option value='".$row['id_matpel']."'>".$row['nama_matpel']."</option>"; 
		}
		return $res;
	}
	//select nomor pertanyaan where spesific matpel and kelas
	public function select_no_pertanyaan_w_m_k($id_kelas,$id_matpel){
		$query = "SELECT nomor_soal FROM tabel_soal ts LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel WHERE mm.kelas_id = $id_kelas AND ts.matpel_id = $id_matpel ";
		$res = NULL;
		// $res =[];
		$res = "<option value=\"0\">pilih nomor soal</option>";
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			// $res[] = $row;
			$res .= "<option value='".$row['nomor_soal']."'>".$row['nomor_soal']."</option>"; 
		}
		return $res;
	}
	//select nomor pertanyaan where spesific matpel and kelas
	public function select_txt_pertanyaan_w_m_k($id_kelas,$id_matpel,$nomor_soal){
		$query = "SELECT * FROM tabel_soal ts LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel WHERE mm.kelas_id = $id_kelas AND ts.matpel_id = $id_matpel AND ts.nomor_soal = $nomor_soal";
		// $res = NULL;
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
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
	//select nilai siswa
	public function select_nilai_siswa(){
		$query = "SELECT tnp.nis,tnp.nama_siswa,tnp.siswa_kelas,mm.nama_matpel,tnp.total_nilai,tnp.tanggal_pengerjaan FROM tabel_nilai_siswa tnp 
		LEFT JOIN master_matpel mm ON tnp.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}
	/**
	 * select all data untuk kunci jawaban
	 * @param $fields 
     * @param $operand
     * @param $keyword 
	 * @return array
	 */
	public function select_kunci_jawaban($fields=null,$operand=null,$keyword=null){
		# code...
		$query = "SELECT ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mkj.bobot,mm.nama_matpel,mk.txt_kelas FROM `master_kunci_jawaban`mkj 
		RIGHT JOIN tabel_soal ts ON mkj.soal_id = ts.id_soal 
		LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}

	/**
	 * select all data untuk pilihan ganda
	 * @param $fields 
     * @param $operand
     * @param $keyword 
	 * @return array
	 */
	public function select_pilihan_ganda($fields=null,$operand=null,$keyword=null){
		$query = "SELECT ts.nomor_soal,ts.text_soal,CONCAT(mps.jawaban_pg,'. ',mps.jawaban_text) as pilihan_ganda,mm.nama_matpel,mk.txt_kelas FROM tabel_soal ts 
		RIGHT JOIN  master_pg_soal mps 
		ON ts.id_soal = mps.soal_id
		LEFT JOIN master_matpel mm 
		ON ts.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk
		ON mm.kelas_id = mk.id_kelas
		GROUP BY ts.text_soal,mps.jawaban_pg";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		// return $result;
		return sizeof($res) > 0 ? $res : null;
	}

	/**
	 * select all data untuk soal
	 * @param $fields 
     * @param $operand
     * @param $keyword 
	 * @return array
	 */
	public function select_soal($fields=null,$operand=null,$keyword=null){
		$query = "SELECT ts.nomor_soal,ts.text_soal,mm.nama_matpel,mk.txt_kelas FROM tabel_soal ts 
		LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$res[] = $row;
		}
		// return $result;
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
	//insert matpel kelas
	public function insert_pg_soal($tablename,$insData){
		// $getKeys = array_keys($insData);
		$columns = implode(", ",array_keys($insData));
        $rawvalues=array();
        foreach ($insData as $key => $value) {
            # code...s
            $rawvalues[] = "\"".$value."\"";
        }
        $values  = implode(", ",$rawvalues);
        $query = "INSERT INTO `".$tablename."`($columns) VALUES (".$values.")";
		
		$execute = mysqli_query($this->conn,$query);
		return $execute;
	}

	/**
	 * insert data ke database
	 * @param $tablename
	 * @param $insData
	 * @return boolean
	 * 
	 *  */
	public function insert_into($tablename,$insData){
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
	//close connection database
	public function close_db(){

		return mysqli_close($this->conn);
	}
}
$models = new Query();
/**
 * SELECT *,CONCAT(mps.jawaban_pg,': ',mps.jawaban_text) AS pilihan_ganda FROM tabel_soal ts 
 *RIGHT JOIN master_pg_soal mps ON ts.id_soal = mps.soal_id
 *LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
 *GROUP BY text_soal,pilihan_ganda
 */