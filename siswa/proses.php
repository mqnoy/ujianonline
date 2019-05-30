<?php
session_start();
if (isset($_POST['login_siswa'])) {
    # code...
    // $_SESSION['nis_siswa'];
    if (empty($_POST['siswa_nis']) || empty($_POST['siswa_nama'])) {
        # code...
        header('Location: ../siswa.php?login_err=101');
    } else {
        $_SESSION['ses_nis_siswa'] = $_POST['siswa_nis'];
        $_SESSION['ses_nama_siswa'] = $_POST['siswa_nama'];
        $_SESSION['is_logged'] = true;
        $_SESSION['is_admin'] = false;
        $_SESSION['is_siswa'] = true;
        header('Location: ../dashboard.php');
    }
}

