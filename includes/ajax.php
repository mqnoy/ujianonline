<?php
include '../includes/app.php';

if (isset($_SESSION['is_logged'])) {
    # code...

    //post lembar soal siswa
    if (isset($_POST['fr_post']) && $_POST['fr_post'] == "post_lembarsoal_siswa") {
        # code...
        $status = false;
        $data = "";
        $nilai = 0;
        if (isset($_POST['pilihan'])) {
            # code...
            $jawaban_siswa = $_POST['pilihan'];

            foreach ($jawaban_siswa as $soalid => $jawaban) {
                # code...
                $kunci_jawaban = $models->select_kunci_jawaban_sis($soalid);
                $periksa_jawaban = periksa_jawaban($jawaban, $kunci_jawaban['jawaban_pg']);
                if ($periksa_jawaban) {
                    # code...
                    $nilai += $kunci_jawaban['bobot'];
                }
            }

            $nama_siswa = $_SESSION['ses_nama_siswa'];
            $nis_siswa = $_SESSION['ses_nis_siswa'];
            $matpelid = $_SESSION['ses_id_matpel'];
            $siswakelas =  $_SESSION['ses_kelas_soal'];
            $id_siswa = 0;
            $select_siswa = $models->select_from("master_siswa", "siswa_nis", "=", $nis_siswa);
            foreach ($select_siswa as $value_siswa) {
                # code...
                $id_siswa = $value_siswa['id_siswa'];
            }
            $insData = array(
                'siswa_id' => $id_siswa,
                'total_nilai' => $nilai,
                'matpel_id' => $matpelid,
                'tanggal_pengerjaan' => tgl_waktu_skrg()
            );
            $insert_nilaisiswa = $models->insert_into("tabel_nilai_siswa", $insData);
            if ($insert_nilaisiswa) {
                # code...
                $data =  "nilai hasilnya = " . $nilai;
                $status = true;
                $response = array(
                    'status' => $status,
                    'data' => $data
                );
            }
        } else {
            $data =  "tidak boleh ada yg kosong !";
            $response = array(
                'status' => $status,
                'data' => $data
            );
        }
        echo json_encode($response);
    }

    //global used post data kelas
    if (isset($_POST['fetch']) && $_POST['fetch'] == "cb_data_kelas") {
        # code...
        $data_kelas = $models->select_kelas();
        if ($data_kelas == null) {
            $response = array(
                'status' => true,
                'data' => "tidak ada data"
            );
        } else {
            $response = array(
                'status' => true,
                'data' => $data_kelas
            );
        }
        echo json_encode($response);
    }
    //terapkan token tuntuk melihat hasil nilai 1 siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "kirim_email_nilai") {
        //cek token siswa
        //select data siswa ,nilai siswa
        //update email di table master siswa
        //kirim ke email 
        $status = false;

        if (isset($_SESSION['token_siswa'])) {
            # code...
            $do_send_email = false;
            $id_siswa = -1;
            $id_matpel = -1;
            $token_siswa = $_SESSION['token_siswa'];
            $list_history_nilai = $models->select_nilai_bytoken($token_siswa);
            // var_dump($list_history_nilai);
            $data = "";
            $nomor = 1;
            $i = 0;
            $email_siswa = null;
            if ($list_history_nilai != null) {
                # code...
                foreach ($list_history_nilai as $value) {
                    # code...
                    $id_siswa = $value['id_siswa'];
                    $id_matpel = $value['id_matpel'];
                    $email_siswa = $value['email_siswa'];
                    $data .= "
                <tr>
                    <td>" . $nomor . "</td>
                    <td>" . $value['nama_matpel'] . "</td>
                    <td>" . $value['total_nilai'] . "</td>
                    <td>" . $value['tanggal_pengerjaan'] . "</td>
                </tr>
                ";
                    $i++;
                    $nomor++;
                }
                $email = $_POST['set_email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // invalid emailaddress
                    $pesan = "format email tidak valid !";
                } else {
                    // check mx domain 
                    $domain = explode("@", $email);
                    $checkerEmail = checkdnsrr($domain[1], 'MX');
                    if ($checkerEmail) {
                        # code...
                        $pesan = "email valid !";
                        if ($email_siswa == null) {
                            # code...
                            $email_siswa = $_POST['set_email'];
                            $update_email_siswa = $models->update_email_siswa($email_siswa, $id_siswa);
                            $do_send_email = true;
                        } else {
                            //cek email input dan email di database
                            if ($_POST['set_email'] === $email_siswa) {
                                # code...
                                $do_send_email = true;
                            } else {
                                $pesan = "email tidak sama dengan database !";
                            }
                        }
                    } else {
                        $pesan = "email tidak valid !";
                    }
                }
            }else{
                $pesan = "list nilai ,sudah pernah di kirim";
            }

            if ($do_send_email) {
                # code...
                //cocokan email di database dan inputan?
                $update_nilai_siswa = $models->update_nilai_siswa($id_siswa, $id_matpel);
                if ($update_nilai_siswa) {
                    # code...
                    $params_replace = array(
                        '{SISWA_NAMA}' => $_SESSION['ses_nama_siswa'],
                        '{SISWA_NIS}' => $_SESSION['ses_nis_siswa'],
                        '{SISWA_TOKEN}' => $_SESSION['token_siswa'],
                        '{DATE_TIME}' =>  date("d/m/Y H:i:s"),
                        '{SISWA_LIST_NILAI}' => $data
                    );
                    $body_mail = build_mail_template($params_replace);

                    $var_datapost = array(
                        "is_html" => true,
                        "sender_name" => "Kelompok3 S6N",
                        "sender_mail" => "admin@keompok3nih.tk",
                        "dest_mail" => $email_siswa,
                        "dest_name" => $_SESSION['ses_nama_siswa'],
                        "subject_mail" => "UjianOnline pilihan ganda SMK ",
                        "body_mail" => $body_mail
                    );
                    $callback = send_email($var_datapost);
                    $status = $callback['status'];
                    $pesan = $callback['data'] . " ke " . $email_siswa;
                } else {
                    $status = false;
                    $pesan = "ada kesalahan update_nilai_siswa() !";
                }
            }
        } else {
            $status = false;
            $pesan = "ada kesalahan token !";
        }
        $response = array(
            'status' => $status,
            'pesan' => $pesan
        );

        echo json_encode($response);
    }

    //pemilihan kelas di list soal siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "terapkan_kelas") {
        $set_kelas = $_POST['set_kelas'];

        $_SESSION['ses_kelas_soal'] = $set_kelas;
        $getkelas = $_SESSION['ses_kelas_soal'];

        $nis_siswa = $_SESSION['ses_nis_siswa'];
        //update siswa kelas
        $update_siswa = $models->update_siswa($getkelas, $nis_siswa);
        if ($update_siswa) {
            # code...
            $response = array(
                'status' => true,
                'kelas_yg_dipilih' => $getkelas
            );
        } else {
            $response = array(
                'status' => false,
                'pesan' => "gagal menerapkan kelas"
            );
        }

        echo json_encode($response);
    }
    //pemilihan matpel di list soal siswa
    if (isset($_POST['aksi_siswa']) && $_POST['aksi_siswa'] == "terapkan_matpel") {
        # code...
        $set_matpel = $_POST['set_matpel'];

        $_SESSION['ses_id_matpel'] = $set_matpel;

        $get_idmatpel = $_SESSION['ses_id_matpel'];
        $response = array(
            'status' => true,
            'matpel_yg_dipilih' => $get_idmatpel
        );

        echo json_encode($response);
    }

    if (isset($_POST['fetch']) && $_POST['fetch'] == "data_listsoal_siswa") {
        # code...
        $getsoal_session = isset($_SESSION['ses_kelas_soal']) ? $_SESSION['ses_kelas_soal'] : false;
        $data_matpel_siswa = $models->select_matpel_kelas($getsoal_session);
        $total_soal = [];
        $data_div = [];
        if ($data_matpel_siswa == null) {
            $response = array(
                'status' => false,
                'data' => "tidak ada data"
            );
        } else {
            foreach ($data_matpel_siswa as $value) {
                # code...
                $i = 0;
                $total_soal = $models->select_count("tabel_soal", "matpel_id", "=", $value['id_matpel']);
                $data_div[] = [
                    "arr_matpel" => $value['nama_matpel'],
                    "arr_totaldata" => $total_soal[$i]['total_data'],
                    "arr_kelas" => $value['txt_kelas'],
                    "arr_matpel_id" => $value['id_matpel']
                ];
                $i++;
            }
            $response = array(
                'status' => true,
                'data' => $data_div
            );
        }
        echo json_encode($response);
    }
}
