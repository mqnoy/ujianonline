<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?php
session_start();
if (isset($_POST['kerjakan'])) {
    # code...
    if (empty($_POST['nm_peserta'])) {
        echo "isi dulu ya :D";
    }else{
        # code...
        $_SESSION['nama_peserta'] = $_POST['nm_peserta'];
        $_SESSION['tampilkan_soal'] = $_POST['tampilkan_soal'];
        $_SESSION['no_soal'] = $_POST['no_soal'];
        $_SESSION['show_lembar_soal'] = true;
        $no_soal= $_SESSION['no_soal'];
        header("Location: ./lembar_soal.php?no_soal=".$no_soal);
    }
}
?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="tampilkan_soal" value="yes"/>
        <input type="hidden" name="no_soal" value="1"/>
        <input type="text" name="nm_peserta" placeholder="eg : rifky"/>
        <br/>
        <input type="submit" name="kerjakan" value="mengerjakan soal"/>
    </form>
</body>
</html>