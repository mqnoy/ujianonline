<?php
define("_DIR_APPS_","ujianonline");

function base_url($SCRIPT_NAME=null){

    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
    $arr = array($uri,_DIR_APPS_,$SCRIPT_NAME);
    $glue = "/";
    $base_url = implode($glue,$arr); 

    return $base_url;
}

// echo base_url();
// phpinfo();
