<?php
/*
 * Twreg using js language
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/

include '../config.php';
$_lang = getLanguage();
if(!$_lang) {
    $_lang = array();
}else {
    $_lang = isset($_lang['js']) ? $_lang['js'] : array();
}

echo "var _lang = " . json_encode($_lang) . ";";
?>
