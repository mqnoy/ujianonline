<?php
/**
 * @return array $soal
 */
function tampil_soal(){
    $soal = array(
        'pilganda_soal_1' => array(
            "soal" => "1 +1 = ?", 
            "pilihan_ganda" => array(
                'A' => "2",
                'B' => "3",
                'C' => "4"
            )
        ), 
        'pilganda_soal_2' => array(
            "soal" => "2 +1 = ?", 
            "pilihan_ganda" => array(
                'A' => "2",
                'B' => "3",
                'C' => "4"
            )
        ), 
        'pilganda_soal_3' => array(
            "soal" => "3 +1 = ?", 
            "pilihan_ganda" => array(
                'A' => "2",
                'B' => "3",
                'C' => "4"
            )
        ),
        'pilganda_soal_4' => array(
            "soal" => "4 +1 = ?", 
            "pilihan_ganda" => array(
                'A' => "2",
                'B' => "3",
                'C' => "4"
            )
        ),
        'pilganda_soal_5' => array(
            "soal" => "5 +1 = ?", 
            "pilihan_ganda" => array(
                'A' => "2",
                'B' => "3",
                'C' => "6"
            )
        ),
    );
    return $soal;
}
/**
 * @return array $kunci_jawaban
 */
function get_kunciJawaban(){
    $kunci_jawaban = array(
        "kunci_jwb_no_1" => 'A',
        "kunci_jwb_no_2" => 'B'   
    );
    return $kunci_jawaban;
}


?>