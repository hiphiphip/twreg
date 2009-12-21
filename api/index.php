<?php
/*
 * Twreg API proccess
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/
error_reporting(0);

require './api.php';
define('API_URL', 'http://'.$_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/', -1)+1));

$api = new API($_GET['l'], $_GET['t']);
$arr = array();

if($_POST) {
    $method = $_GET['m'];
    if(method_exists($api, $method)) {
        $api->$method($_POST);
    }else {
        $arr['msg'] = $api->_l('Wrong method!');
        $api->output($arr);
    }
}else {
    if(!$_GET['m']) {
        $arr['msg'] = $api->_l('Wrong method!');
        $api->output($arr);
    }else {
        $method = $_GET['m'];
        if(method_exists($api, $method)) {
            if(isset($_GET['s'])) {
                $api->$method($_GET['s']);
            }else {
                $api->$method();
            }
        }else {
            $arr['msg'] = $api->_l('Wrong method!');
            $api->output($arr);
        }
    }
}
?>
