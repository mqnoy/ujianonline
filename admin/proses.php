<?php
session_start();
include '../includes/Query.php';

if (isset($_SESSION['is_logged']) && $_SESSION['is_admin'] == true) {
    # code...

    //post matapelajaran
    if (isset($_POST['fr_post_matpel'])) {
        # code...
        $status = false;
        if (empty($_POST['nm_matpel'])) {
            # code...
            $response = array(
                'status' => false,
                'data' => "nama mata pelajaran tidak boleh kosong !"
            );
        } else if ($_POST['matpel_kelas'] == null || $_POST['matpel_kelas'] == 0) {
            $response = array(
                'status' => false,
                'data' => "kelas harus di pilih !"
            );
        } else {
            $data = array(
                'nama_matpel' => $_POST['nm_matpel'],
                'kelas_id' => $_POST['matpel_kelas']
            );
            $insert_matpel = $models->insert_matpel("master_matpel", $data);
            if ($insert_matpel) {
                # code...
                $data = "matpel berhasil di tambah";
                $status = true;
            }
            $response = array(
                'status' => $status,
                'data' => $data
            );
        }
        echo json_encode($response);
    }

    //post matapelajaran
    if (isset($_POST['fr_post_pilihanganda'])) {
        # code...
        $soal_id = $_POST['soalid'];
        $pg_soal = $_POST['pg_soal'];
        $data = [];
        $abjad_pilihan = array("A", "B", "C", "D");
        foreach ($pg_soal as $key => $value) {
            # code...
            $data[$key] = array(
                'soal_id' => $soal_id,
                'jawaban_pg' => $abjad_pilihan[$key],
                'jawaban_text' => $pg_soal[$key]
            );
            $insert_pg_soal[$key] = $models->insert_pg_soal("master_pg_soal", $data[$key]);

            if ($insert_pg_soal[$key]) {
                # code...
                $response = array(
                    'status' => true,
                    'data' => "pilihan ganda berhasil di tambah"
                );
            }
        }
        echo json_encode($response);
    }

    //post soal
    if (isset($_POST['fr_post_soal'])) {
        # code...
        // $message =  htmlentities($_POST);

        $status = false;
        if (empty($_POST['txt_pertanyaan'])) {
            # code...
            $response = array(
                'status' => false,
                'data' => "pertanyaan tidak boleh kosong !"
            );
        } else if ($_POST['nm_matpel'] == null || $_POST['nm_matpel'] == 0) {
            $response = array(
                'status' => false,
                'data' => "mata pelajaran harus di pilih !"
            );
        } else {
            $data = array(
                'nomor_soal' => $_POST['no_pertanyaan'],
                'text_soal' => $_POST['txt_pertanyaan'],
                'matpel_id' => $_POST['nm_matpel']
            );
            $insert_matpel = $models->insert_into("tabel_soal", $data);
            if ($insert_matpel) {
                # code...
                $data = "soal baru berhasil di tambah";
                $status = true;
            }
            $response = array(
                'status' => $status,
                'data' => $data
            );
        }
        echo json_encode($response);
    }

    //cari nama matpel
    if (isset($_POST['tampil']) && $_POST['tampil'] == "cr_nama_matpel") {
        # code...
        if ($_POST['idkelas'] == 0) {
            # code...
            $response = array(
                'status' => true,
                'data' => "belum dipilih"
            );
        } else {
            $id_kelas = $_POST['idkelas'];
            $data_matpel = $models->select_matpel_w_kelas($id_kelas);
            if ($data_matpel == null) {
                # code...
                $response = array(
                    'status' => false,
                    'data' => $data_matpel
                );
            } else {
                $response = array(
                    'status' => true,
                    'data' => $data_matpel
                );
            }
        }
        echo json_encode($response);
    }
    //cari no soal
    if (isset($_POST['tampil']) && $_POST['tampil'] == "cr_nomor_soal") {
        # code...
        $id_kelas = $_POST['idkelas'];
        $id_matpel = $_POST['idmatpel'];
        $data_nomor_soal = $models->select_no_pertanyaan_w_m_k($id_kelas, $id_matpel);
        if ($data_nomor_soal == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $response = array(
                'status' => true,
                'data' => $data_nomor_soal
            );
        }
        echo json_encode($response);
    }
    //cari pertanyaan
    if (isset($_POST['tampil']) && $_POST['tampil'] == "cr_txt_pertanyaan") {
        # code...
        $id_kelas = $_POST['idkelas'];
        $id_matpel = $_POST['idmatpel'];
        $nomor_soal = $_POST['nomorsoal'];
        $data_soal = $models->select_txt_pertanyaan_w_m_k($id_kelas, $id_matpel, $nomor_soal);
        if ($data_soal == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $data = null;
            foreach ($data_soal as $value) {
                # code...
                $data = $value;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        echo json_encode($response);
    }
    /**
     * menampilkan semua soal beserta kunci jawabannya
     * @param $fields 
     * @param $operand
     * @param $keyword 
     * */
    if (isset($_POST['tampil']) && $_POST['tampil'] == "tam_kunci_jawaban") {
        # code...
        $data_soal_kunci_jawaban = $models->select_kunci_jawaban();
        if ($data_soal_kunci_jawaban == null) {
            # code...
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        }else{
            $data = [];
            $nomor=1;
            // ts.nomor_soal,ts.text_soal,mkj.jawaban_pg,mm.nama_matpel,mk.txt_kelas
            foreach ($data_soal_kunci_jawaban as $value) {
                # code...
                $jawaban_pg = $value['jawaban_pg'] == null ? "belum di set" : $value['jawaban_pg'] ;
                $data []= "
                <tr>
                    <td>".$nomor."</td>
                    <td>".$value['nomor_soal']."</td>
                    <td>".strip_tags($value['text_soal'])."</td>
                    <td>".$jawaban_pg."</td>
                    <td>".$value['nama_matpel']."</td>
                    <td>".$value['txt_kelas']."</td>
                    <td>
                        <div class='btn-group'>
                            <a class='margin' data-toggle='modal' data-target='#modal-pilihan-ganda'>
                                <button type='button' class='btn  btn-warning'><i class='fa fa-edit'></i></button>
                            </a>
                        </div>
                    </td>
                    </tr>
                ";
                $nomor++;
            }
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        // var_dump($data);
        echo json_encode($response);
    }


}/**end sessions */
