<?php

Header("Content-type:image/jpeg");
if(isset($_GET['s']) && $_GET['s']) {
    $server = $_GET['s'];
}else {
    $server = 'https://www.google.com/recaptcha/api/image?c=';
}
ob_start();
echo file_get_contents($server . 'image?c=' . $_GET['c']);
ob_end();

?>