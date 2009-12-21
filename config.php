<?php
/*
 * API Proxy
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/

define('APP_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('API_URL', 'http://twreg.info/api/');
define('TWREG_URL', 'http://'.$_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/', -1)+1));

$_lang = array();
if(isset($_GET['l'])) {
    $language = isset($_GET['l']) ? $_GET['l'] : 'zh-cn';
    setcookie('twreg_language', $language, time()+3600*24*30, '/');
} else {
    if(isset($_COOKIE['twreg_language'])) {
        $language = $_COOKIE['twreg_language'];
    }else {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'zh-CN;')!==false) {
            $language = 'zh-cn';
        }else {
            $language = 'en';
        }
    }
}

include APP_ROOT . 'i/function.php';



?>
