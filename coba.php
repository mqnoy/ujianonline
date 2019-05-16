<?php

function lang($str){

    return $str;
}
// $pecah_string = explode("/",$string);
// var_dump($pecah_string[5]);

// $__campaign_id =  str_replace("https://","//",str_replace("http://","//",$logo));

$__campaign_id = "//connect.zonawifi.co.id/assets/campaigns/447/logo.png";
$pecah_string = explode("/",$__campaign_id);
//echo $pecah_string[5];//447 ikea

if ($pecah_string[5] == "447" ) {
    # code...
    $link_termsnya = "https://ikea.co.id/in/kebijakan-privasi";
}else{
    $link_termsnya = "http://zonawifi.co.id/terms";
}

?>
<a href="<?php echo $link_termsnya;?>"><?php echo lang('footer_terms'); ?></a> &middot;
                <a href="http://zonawifi.co.id/privacy-policy"><?php echo lang('footer_policy'); ?></a>

<a href="http://zonawifi.co.id/terms"><?php echo lang('footer_terms'); ?></a> &middot;
