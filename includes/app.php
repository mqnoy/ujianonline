<?php
define("_DIR_APPS_", "ujianonline");
session_start();
require_once("Query.php");


function base_url($SCRIPT_NAME = null)
{

    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    $arr = array($uri, _DIR_APPS_, $SCRIPT_NAME);
    $glue = "/";
    $base_url = implode($glue, $arr);

    return $base_url;
}

//fungsi untuk mencocokan jawaban siswa dengan kunci jawaban di database
function periksa_jawaban($jawaban, $kunci_jawaban)
{
    $ret = false;
    if ($jawaban === $kunci_jawaban) {
        # code...
        $ret = true;
    }
    return $ret;
}

//fungsi untuk generate token siswa diperlukan ketika melihat hasil nilai
function generate_tokenSiswa($string)
{
    $acak = str_shuffle("1234ABCDEFGH");
    $raw = $string . $acak;
    // $generate_token = base64_encode($raw);
    $generate_token = $raw;
    return $generate_token;
}

//fungsi untuk mengambill tanggal sekarang 
function tgl_waktu_skrg()
{
    return date("Y-m-d H:i:s");
}

//fungsi untuk clear tag html dengan pengecualian
function clear_tags($content)
{
    $allowed_tags = "<img></img><blockquote></blockquote><ul></ul><ol></ol><li></li><font></font><b></b><s></s><i></i><br></br><br/><p></p><table></table><tr></tr><td></td><tbody></tbody>";
    return strip_tags($content, $allowed_tags);
}

$hal_aktif = function ($str_halaman) {
    // unset($_SESSION['halaman_aktif']);
    // $_SESSION['halaman_aktif'] = $str_halaman;
    return $_SESSION['halaman_aktif'] = $str_halaman;
};

//thx : https://stackoverflow.com/questions/20720016/including-template-file-in-php-and-replacing-variables
function build_mail_template($params_replace)
{
    $get_keys = array_keys($params_replace);
    $get_val = array_values($params_replace);
    $template_mail = file_get_contents("template_email.html");
    // return $get_val;
    return str_replace($get_keys, $get_val, $template_mail);
}
//fungsi untuk kirim email
function send_email($var_datapost = null)
{
    $url = "http://206.189.42.174:8080/sendmail/";
    if ($var_datapost != null) {
        # code...
        $fields = $var_datapost;
    } else {
        $fields = array(
            "is_html" => true,
            "sender_name" => "Kelompok3 S6N",
            "sender_mail" => "admin@keompok3nih.tk",
            "dest_mail" => "qnoy.rifky@gmail.com",
            "dest_name" => "dest_name",
            "subject_mail" => "UjianOnline pilihan ganda SMK ",
            "body_mail" => "NOTHING!"
        );
    }

    //url-ify the data for the POST
    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);

    return json_decode($result, true);
}
// $anuan = build_mail_template();

// var_dump( $anuan);
// send_email();
