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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_l('Twitter Register Proxy!')?></title>
</head>
<style type="text/css">
body	{ font-size:16px; font-family:Arial, Helvetica, sans-serif; background-color:#E6F5F8; height:100%;}
textarea	{ font-size:12px; font-family:Arial, Helvetica, sans-serif;}
</style>
<body>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:30px;">
  <tr>
    <td align="right"><p><img src="res/t.gif" width="347" height="246" /></p>
    <p>You can put the button in your blog as: </p>
    <p><script src="./widget.js"></script></p>
    <p>Use javascript code as: </p>
    <p>
      <label>
      <textarea name="textarea" id="textarea" cols="45" rows="4" style="border:solid 5px #83D4EA; padding:5px;" onfocus="this.select();"><script>var twreg_widget_url = '<?=TWREG_URL?>widget.php?widget=true';</script>
<script src="<?=TWREG_URL?>widget.js"></script></textarea>
      </label>
    </p></td>
    <td width="500" align="right">
    	<iframe src="./widget.php?widget=true" frameborder="0" scrolling="no" height="470" width="470"></iframe>
    </td>
  </tr>
</table>
</body>
</html>
