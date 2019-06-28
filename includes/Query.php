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
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		return sizeof($res) > 0 ? $res : null;
	}
	// select matpel join kelas
	public function select_matpel(){
		$query = "SELECT * FROM master_matpel mm LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
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
		while($row=mysqli_fetch_assoc($result)){
			// $res[] = $row;
			$res .= "<option value='".$row['id_matpel']."'>".$row['nama_matpel']."</option>"; 
		}
		return $res;
	}
	//select list matpel untuk siswa
	public function select_matpel_kelas($keyword=null){
		$res =[];
		$query = "";
		// WHERE mk.kelas = 1";
		if ($keyword != null) {
			# code...
			$query = "SELECT mm.nama_matpel,mk.txt_kelas,mk.kelas,mm.id_matpel FROM master_matpel mm 
			LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas ";
			$query .= "WHERE mk.kelas = ".$keyword;
			$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)){
				$res[] = $row;
			}
		}
		
		// return $query;
		return sizeof($res) > 0 ? $res : null;
	}
	//select count [query builder]
	public function select_count($tabels=null,$field=null,$operand=null,$keyword=null){
		$query = "SELECT COUNT(*) AS total_data FROM ".$tabels." "; 
		if ($keyword != null ) {
			# code...
			$query .= "WHERE ".$field."".$operand."".$keyword;
		}
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		// return $query;
		return sizeof($res) > 0 ? $res : null;
	}
	/**
	 *  select list soal untuk halaman lembar soal siswa
	 *  @param idmatpel
	 *  @param idkelas
	 *  @return array
	*/
	public function select_soal_siswa($id_kelas=null,$id_matpel=null){
		$res =[];
		$query = "";
			# code...
			$query = "SELECT *,CONCAT(nomor_soal,'. ',text_soal) AS text_soal_sis FROM tabel_soal ts 
			LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
			LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas
			INNER JOIN master_pg_soal mps ON ts.id_soal = mps.soal_id "; 
			$query .= " WHERE ts.matpel_id = '".$id_matpel."' AND mm.kelas_id = ".$id_kelas;
			$query .= " GROUP BY (text_soal)";
			$query .= " ORDER BY  ts.id_soal ASC ";
			$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)){
				$res[] = $row;
			}
		// mysqli_free_result($result);

		// return $query;
		// var_dump($query);
		return sizeof($res) > 0 ? $res : null;
	}
	public function select_kunci_jawaban_sis($id_soal){
		// $res =[];
		$query = "";
			# code...
			$query = "SELECT * FROM master_kunci_jawaban WHERE soal_id = '".$id_soal."'";
			$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)){
				// $res[] = $row;
				$res = $row;
			}
		// mysqli_free_result($result);
		// return $query;
		return sizeof($res) > 0 ? $res : null;
	}
	/**
	 *  select list pulihan ganda soal untuk halaman lembar soal siswa
	 *  @param idmatpel
	 *  @param idkelas
	 *  @return array
	*/
	public function select_pgsoal_siswa($id_soal=null){
		$res =[];
		$query = "";
			# code...
			$query = "SELECT *,CONCAT(jawaban_pg,'. ',jawaban_text) as pilihan_ganda FROM master_pg_soal";
			$query .= " WHERE soal_id = '".$id_soal."'";
			$query .= " ORDER BY jawaban_pg ASC";
			$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)){
				$res[] = $row;
			}
		// mysqli_free_result($result);

		// return $query;
		return sizeof($res) > 0 ? $res : null;
	}

	//select nomor pertanyaan where spesific matpel and kelas
	public function select_no_pertanyaan_w_m_k($id_kelas,$id_matpel){
		$query = "SELECT nomor_soal FROM tabel_soal ts LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel WHERE mm.kelas_id = $id_kelas AND ts.matpel_id = $id_matpel ";
		$res = NULL;
		// $res =[];
		$res = "<option value=\"0\">pilih nomor soal</option>";
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
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
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		return $res;
	}
	//select kelas
	public function select_kelas(){
		$query = "SELECT * FROM master_kelas";
		$res = NULL;
		// $res =[];
		$res = "<option value=\"0\">pilih kelas</option>";
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
			// $res[] = $row;
			$res .= "<option value='".$row['id_kelas']."'>".$row['txt_kelas']."</option>"; 
		}
		return $res;
	}
	//select nilai siswa by token
	public function select_nilai_bytoken($token_siswa,$nis_siswa){
		$res = null;
		$query = "SELECT * FROM tabel_nilai_siswa tns INNER JOIN master_siswa ms ON tns.siswa_id = ms.id_siswa
		WHERE ms.token_siswa = '".$token_siswa."' AND ms.siswa_nis='".$nis_siswa."'";

		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		// mysqli_free_result($result);

		// return $query;
		return sizeof($res) > 0 ? $res : null;
	}
	//select nilai siswa
	public function select_nilai_siswa(){
		$query = "SELECT ms.siswa_nis,ms.siswa_nama,mk.txt_kelas,mm.nama_matpel,tnp.total_nilai,tnp.tanggal_pengerjaan FROM tabel_nilai_siswa tnp 
		LEFT JOIN master_siswa ms ON tnp.siswa_id = ms.id_siswa
        LEFT JOIN master_matpel mm ON tnp.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
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
		$query = "SELECT ts.id_soal,ts.matpel_id,ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mkj.bobot,mm.nama_matpel,mk.txt_kelas FROM `master_kunci_jawaban`mkj 
		RIGHT JOIN tabel_soal ts ON mkj.soal_id = ts.id_soal 
		LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";
		if ($fields != null && $operand != null && $keyword != null) {
			# code...
			$query .= " WHERE ".$fields." ".$operand."'".$keyword."'";

		}
		$res =[];
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
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
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		// return $result;
		return sizeof($res) > 0 ? $res : null;
		// var_dump($query);
	}

	/**
	 * select all data untuk soal
	 * @param $fields 
     * @param $operand
     * @param $keyword 
	 * @return array
	 */
	public function select_soal($fields=null,$operand=null,$keyword=null){
		$res=null;
		$query="";

		$query = "SELECT ts.nomor_soal,ts.text_soal,ts.id_soal,mm.nama_matpel,mk.txt_kelas FROM tabel_soal ts 
		LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
		LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas";

		if ($fields != null && $keyword != null) {
			# code...
			$query .= " WHERE ".$fields."".$operand."".$keyword;
		}

		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		// return $result;
		return sizeof($res) > 0 ? $res : null;
	}
	

	//select data dari database
	public function select_from($tablename,$field=null,$operand=null,$keyword=null){
		$query="";
		$res = null;
		$query = "SELECT * FROM ".$tablename;
		if ($field != null && $operand != null) {
			# code...
			$query .= " WHERE ".$field."".$operand."'".$keyword."'";
		}
		$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)){
				$res[] = $row;
			}
		// mysqli_free_result($result);

		// return $query;
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
	public function insert_into($tablename,$insData=null){
		$execute = false;
		if ($insData != null) {
			# code...
			$columns = implode(", ",array_keys($insData));
			$rawvalues=array();
			foreach ($insData as $key => $value) {
				# code...
				$rawvalues[] = "\"".$value."\"";
			}
			$values  = implode(", ",$rawvalues);
			$query = "INSERT INTO `".$tablename."`($columns) VALUES (".$values.")";
			
			$execute = mysqli_query($this->conn,$query);
		}
		
		return $execute;
	}
	public function update_kunci_jawaban($id_soal,$jawaban_pg,$bobot_pg){
		$query = "UPDATE master_kunci_jawaban SET jawaban_pg='".$jawaban_pg."' ,bobot='".$bobot_pg."' WHERE soal_id='".$id_soal."'";
		$execute = mysqli_query($this->conn,$query);
		return $execute;
	}
	public function update_siswa($id_kelas,$nis_siswa){
		$query = "UPDATE master_siswa SET siswa_kelas_id='".$id_kelas."' WHERE siswa_nis='".$nis_siswa."'";
		$execute = mysqli_query($this->conn,$query);
		return $execute;

	}
	// public function update_soal_kuncijwbn($id_soal,$kunci_jawaban){
	// 	$query = "UPDATE master_siswa SET siswa_kelas_id='".$id_kelas."' WHERE siswa_nis='".$nis_siswa."'";
	// 	$execute = mysqli_query($this->conn,$query);
	// 	return $execute;

	// }
	//close connection database
	public function close_db(){

		return mysqli_close($this->conn);
	}
}
$models = new Query();
/*
SELECT *,CONCAT(mps.jawaban_pg,': ',mps.jawaban_text) AS pilihan_ganda FROM tabel_soal ts 
 RIGHT JOIN master_pg_soal mps ON ts.id_soal = mps.soal_id
 LEFT JOIN master_matpel mm ON ts.matpel_id = mm.id_matpel
 GROUP BY text_soal,pilihan_ganda


 SELECT COUNT(*) FROM (SELECT mm.nama_matpel,mk.txt_kelas,mk.kelas FROM master_matpel mm 
LEFT JOIN master_kelas mk ON mm.kelas_id = mk.id_kelas
LEFT JOIN tabel_soal ts ON mm.id_matpel = ts.matpel_id
WHERE mk.kelas = '1'
) AS total_soal
 */