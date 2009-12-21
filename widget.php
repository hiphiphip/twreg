<?php
/*
 * INDEX SHOW
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/

include './config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_l('Twitter Register Proxy!')?></title>
<script src="./res/js/jquery-1.3.2.min.js"></script>
<script src="./i/language_js.php"></script>
<script src="./res/js/global.js"></script>
<style type="text/css">
body	{ margin: 0px; padding: 0px; color: #333; font-size:14px; font-family: <?=_l("'Arial',sans-serif")?>; <?php if($_GET['widget']=='true'){ ?>background: transparent;<?php }else{ ?>background: #E6F5F8;<?php } ?>}
input	{ font-size: 14px; color: #333; font-family: 'Arial',sans-serif;}
a   { color:#E83228;}
a:hover	{ color:#009;}
#wrap	{ margin: 10px auto; width:430px; padding:10px; background-color: #fff;  -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius: 5px; border-radius: 5px; height:430px; overflow:hidden;}
#wrap_mask  { margin: 0 auto; width:470px; height:470px; background-color: #83D4EA; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius: 5px; border-radius: 5px; position:absolute; top:0px; z-index:-1; margin-left:-235px; left:50%; opacity:0.5; filter:alpha(opacity=40); }
#signup	.line	{ margin: 8px 0px; padding: 5px;}
#signup .line span	{ display: inline-block; width: 90px; color:#36B6D9; font-weight:bold;}
#reloadImg  { cursor: pointer; background:#f3f3f3; padding: 5px; margin-left:5px; text-align: center;}
#recaptchaImg	{ width:300px; height: 57px; border: solid 1px #ccc;}
.line i	{ color: #666; font-size: <?=_l('10px')?>; font-style: normal; font-family: 'Arial'; padding-left:5px; width:160px; overflow:hidden; display:inline-block;}
.line i.er  { color:#900;}
.line i.ok  { color:#090;}
#header	{ text-align: center; font-size: 18px; font-weight: bold; color:#36B6D9;}
#footer	{text-align: right; color: #999; font-size: 11px;}
#error_info { color:#f00; font-size:12px;}
</style>
</head>
<body>
    <div id="wrap">
	<div id="header"><?=_l('Register Twitter')?> <span id="error_info"></span></div>
	<form method="post" action="./create.php" id="signup">
	    <div style="display:hidden;">
		<input type="hidden" name="authenticity_token" id="authenticity_token" value="" />
		<input type="hidden" id="recaptcha_challenge_field" name="recaptcha_challenge_field" />
	    </div>
	    <div class="line name"><span><?=_l('Name')?>:</span><input type="text" name="name" id="name" /><i></i></div>
	    <div class="line screen_name"><span><?=_l('Username')?>:</span><input type="text" name="screen_name" id="screen_name" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /><i></i></div>
	    <div class="line password"><span><?=_l('Password')?>:</span><input type="password" name="password" id="password" /><i></i></div>
	    <div class="line repassword"><span><?=_l('Re-Type')?>:</span><input type="password" name="repassword" id="repassword" /><i></i></div>
	    <div class="line email"><span><?=_l('Email')?>:</span><input type="text" name="email" id="email" /><i></i></div>
	    <div class="line" style="text-align:center;"><img id="recaptchaImg" style="margin-bottom:-8px;" /><a href="#" id="reloadImg"><?=_l('Reload')?></a></div>
	    <div class="line captcha"><span><?=_l('Type words')?>:</span><input type="text" size="15" name="captcha" id="captcha" /><i></i></div>
	    <div class="line" style="text-align: center;"><input type="submit" value=" <?=_l('Create Account!')?> " /></div>
	</form>
        <div id="footer"><a href="http://code.google.com/p/twreg/" target="_blank"><?=_l('Get Open Source!')?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./" target="_blank"><?=_l('Get Widget!')?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?=_l('Please feedback to')?> <a href="http://twitter.com/hfcorriez" target="_blank">@hfcorriez</a> <a href="http://twfav.com" target="_blank">@Twfav</a> Team</div>
    </div>
    <div id="wrap_mask"></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11833635-2");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>