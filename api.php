<?php
/*
 * API Proxy
 *
* Developed by @hfcorriez at 11/21/2009
 *
*/

require_once 'config.php';

$url = API_URL . '?' . $_SERVER['QUERY_STRING'];
$data = http($url);
echo $data['response'];

?>