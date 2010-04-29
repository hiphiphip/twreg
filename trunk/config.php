<?php
/*
 * API Proxy
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/

define('APP_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('API_URL', 'http://'.$_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/', -1)+1) . 'api/');
define('TWREG_URL', 'http://'.$_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/', -1)+1));
#define('TWREG_CAPTCHA_URL', 'http://twreg.info/api/captcha.php');
define('TWREG_CAPTCHA_URL', false);

$_lang = array();
if(isset($_GET['l'])) {
    $language = isset($_GET['l']) ? $_GET['l'] : 'zh-cn';
    setcookie('twreg_language', $language, time()+3600*24*30, '/');
} else {
    if(isset($_COOKIE['twreg_language'])) {
	$language = $_COOKIE['twreg_language'];
    }else {
	$language = 'zh-cn';
    }
}

include APP_ROOT . 'i/function.php';



?>
