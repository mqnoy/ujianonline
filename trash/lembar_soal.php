<?php
//thx for :https://stackoverflow.com/questions/2306159/array-as-session-variable
session_start();
include "./includes/Soal_list.php";

//panggil function soal list
$soal = tampil_soal();
/**
 * @param $no_soal
 */
$tampil_pilihanGanda = function ($val_no_soal=1) use ($soal){
    foreach ($soal['pilganda_soal_'.$val_no_soal]['pilihan_ganda'] as $key => $value) {
        # code...
        echo "<input type=\"radio\" name=\"pilihan[pilihan_ganda_$val_no_soal]\" value=\"$key\" /> $value<br/>";
    }
};
if (isset($_SESSION['show_lembar_soal'])) {
    # code...
    $nama_peserta = $_SESSION['nama_peserta'];
    $tampil_soal_bool=false;
    $notif="";
    $url_action = $_SERVER['PHP_SELF'];
    $no_soal = isset($_GET['no_soal']) ? $_GET['no_soal'] : $_SESSION['no_soal']+1;

    if ($_GET['no_soal'] > sizeof($soal)) {
        # code...
        // push jawaban sebelum terakhir
        // @bug
        array_push($_SESSION['jawaban_soal'] ,$_POST['pilihan']);
        
        $no_soal = 1;
        $counter_nilai_benar=0;
        $counter_nilai_salah=0;
        foreach ($_SESSION['jawaban_soal'] as $key => $value) {
            # code...
            $jawaban_peserta = $value['pilihan_ganda_'.$no_soal];
            if ($jawaban_peserta == $kunci_jawaban['kunci_jwb_no_'.$no_soal]) {
                # code...
                echo "no soal $no_soal | jawaban : $jawaban_peserta | hasil : BENAR <br>";
                $counter_nilai_benar +=1;
            }else{
                echo "no soal $no_soal | jawaban : $jawaban_peserta | hasil : salah <br>";
                $counter_nilai_salah +=1;
            }
            $no_soal++;
        }
        echo "<br>";
        echo "total nilai benar = $counter_nilai_benar";
        echo "<br>";
        echo "total nilai salah = $counter_nilai_salah";

        echo "<h2><a href='?no_soal=1' target='_self'>kerjakan soal lagi</a><h2>";

    }

    if (isset($_SESSION['notif'])) {
        # code...
        $notif = "notif : ".$_SESSION['notif'];
    }
    echo "$notif";
    echo "<h1>selamat mengerjakan $nama_peserta,jangan mencontek!</h1> <br/>";
    echo "tampilkan soal ke $no_soal <br>";
    if ($no_soal != 0) {
        # code...
        echo "<h4>pertanyaan : ".$soal['pilganda_soal_'.$no_soal]['soal']."</h4>";
    }
    echo "<form action=".$url_action." method='GET'>";
        # code...
        //tampilkan soal jika no_soal tidak  0
        if ($no_soal != 0) {
            # code...
            $tampil_pilihanGanda($no_soal);
        }
    ?> 
    <input type="hidden" value="<?php echo $no_soal;?>" name="no_soal">
    <input type="submit" name="lanjut_soal" value="lanjut"/>
    <input type="button" value="kembali" onclick="window.history.back();"/>
    </form>
<?php

if (isset($_GET['lanjut_soal'])) {
    # code...
    $soal_next = $_GET['no_soal']+1;
    echo "soal next = ".$soal_next;
    $url_next = $_SERVER['PHP_SELF']."?no_soal=".$soal_next;
    header("Location: $url_next");
}

}else{
    session_unset(); 
    session_destroy(); 
    header("Location: ./form_data_peserta.php");
}

?>
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
</html>