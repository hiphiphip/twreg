<?php
/*
 * Twreg function
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/


function http($url, $post_data = null) { /*{{{*/
    $ch = curl_init ();
    if (defined ( "CURL_CA_BUNDLE_PATH" ))
	curl_setopt ( $ch, CURLOPT_CAINFO, CURL_CA_BUNDLE_PATH );
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
    curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, array( 'User-Agent: Mozilla/5.0 (Windows NT 5.1; U; zh-cn; rv:1.8.1) Gecko/20091102 Firefox/3.5.5' ));
    //////////////////////////////////////////////////
    ///// Set to 1 to verify Twitter's SSL Cert //////
    //////////////////////////////////////////////////
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    if (isset ( $post_data )) {
	$var = '';
	foreach ( $post_data as $key => $value )
	    $var .= '&' . $key . '=' . addslashes ( $value );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $var );
    }
    $response = curl_exec ( $ch );
    $header = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
    curl_close ( $ch );
    return array('http_code'=>$header, 'response'=>$response);
}

function cutstr($str, $strStart, $strEnd) {
    $posStart = strpos($str, $strStart);
    $posEnd = strpos($str, $strEnd, $posStart);
    return substr($str, $posStart + strlen($strStart), $posEnd - $posStart - strlen($strStart));
}

function _l($key) {
    global $_lang, $language;
    if(!$language)
	$language = 'en';
    $_lang = getLanguage();
    if(isset($_lang[$key]))
	return $_lang[$key];
    else
	return $key;
}

function getLanguage( $lang = '') {
    global $language, $_lang;
    if(!$lang) {
	$lang = $language;
    }
    if(!$_lang)
	$_lang = i('i/language/' . $lang);
    return $_lang;
}

function i($str, $ext = '.php') {
    static $imported_files = array ();
    if (! empty ( $imported_files [$str] ) && $imported_files [$str] === 1) {
	return TRUE;
    }
    if (strpos ( $str, '/' ) !== false) {
	$str = APP_ROOT . str_replace ( '/', DIRECTORY_SEPARATOR, $str ) . $ext;
    }
    if(file_exists($str)) {
	$imported_files [$str] = 1;
	return (include_once $str);
    }
    return  false;
}

?>
