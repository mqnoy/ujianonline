<?php
// $soal = array(
//     'soal_1' => ['A','B','C'], 
//     'soal_2' => ['A','B','C']
// );
// $kunci_jawaban = array(
//     0 => ['A'], 
//     2 => ['B']
// );

// $jawaban_peserta = array(
//     0 => ['A'], 
//     2 => ['B']
// );

// $hasil = [];


// foreach ($soal as $key => $value) {
//     # code...
//     // if ($soal[$key]) {
//     //     # code...
//     // }
//     var_dump($soal[0]);

// }
// die();
// //looping untuk list soal
// for ($i=0; $i < sizeof($soal); $i++) { 
    
//     //loping untuk list jawaban
//     for ($j=0; $j < sizeof($jawaban_peserta); $j++) { 
//         echo $soal[0];
//         var_dump($soal);

//     }
    
// }


$soal = array(
    'pilganda_soal_1' => array(
        'A' => "2",
        'B' => "3",
        'C' => "4"
    ), 
    'pilganda_soal_2' => array(
        'A' => "7",
        'B' => "3",
        'C' => "4"
    ), 
);
$kunci_jawaban = array(
    "soal_no_1" => 'A',
    "soal_no_2" => 'C'   
);
if (isset($_POST['submit_jawaban'])) {
    # code...
    echo "<pre>".print_r($_POST['pilihan'],true)."</pre>
    <br>
    ";
    //parsing jawaban
    $soal_no = 1;
    foreach ($_POST['pilihan'] as $key => $value) {
        # code...
        
        if ($_POST['pilihan'][$key] === $kunci_jawaban['soal_no_'.$soal_no]) {
            # code...
            echo "nomor ".$key."benar <br>";
        }else {
            # code...
            echo "nomor ".$key."salah<br>";
        }
        $soal_no++;    
        
    }
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
    <form action="" method="post">
        <h4>berapakah 1+1 = ?</h4>
        <?php
            for ($i=1; $i <= 2; $i++) { 
                # code...
                foreach ($soal['pilganda_soal_'.$i] as $key => $value) {
                    # code...
                    $val = $key;
                    // var_dump($key);

                    $rd_name = "pilihan[pilganda_soal_$i]";
                    echo "<input type='radio' name=\"$rd_name\" value=\"$val\" />$value";
                }
            }

            die();
        ?>
        <input type="radio" name="pilihan[pilganda_soal_1]" value="A"/>2
        <br/>
        <input type="radio" name="pilihan[pilganda_soal_1]" value="B"/>3
        <br/>
        <input type="radio" name="pilihan[pilganda_soal_1]" value="C"/>4
        <br/>

        <h4>berapakah 3+1 = ?</h4>
        <input type="radio" name="pilihan[pilganda_soal_2]" value="A"/>7
        <br/>
        <input type="radio" name="pilihan[pilganda_soal_2]" value="B"/>3
        <br/>
        <input type="radio" name="pilihan[pilganda_soal_2]" value="C"/>4
        <br/>

        <input type="submit" value="kirim jawaban" name="submit_jawaban"/>
    </form>
</body>
</html>