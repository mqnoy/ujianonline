<?php
session_start();

var_dump($_SESSION);
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
    # code...
    if ($_SESSION['is_admin']) {
        # code...
        echo "admin here";
        session_destroy();
        session_unset();
        header('Location: ./admin.php?msg=logout');
    }else{
        echo "not admin !";
        session_destroy();
        session_unset();
        header('Location: ./siswa.php?msg=logout');
    }
}