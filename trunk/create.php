<?php
include './config.php';
if($_POST) {
    $postData['name'] = $_POST['name'];
    $postData['screen_name'] = $_POST['screen_name'];
    $postData['email'] = urlencode($_POST['email']);
    $postData['password'] = $_POST['password'];
    $postData['recaptcha_response'] = $_POST['captcha'];
    $postData['recaptcha_challenge'] = $_POST['recaptcha_challenge_field'];
    $postData['authenticity_token'] = $_POST['authenticity_token'];
    //$postData['debug'] = 'true';
    $post = http(API_URL . '?m=create&t=serialize&l=' . $language, $postData);
    //var_dump($post);
    $post = @unserialize(stripslashes($post['response']));
    if($post['errcode'] == '0') {
        $msg = $post['msg'];
        $class = 'ok';
    }elseif($post['errcode'] == '1') {
        $msg = $post['msg'] . ', ' . _l('Please <a href="javascript:history.back();">back and retry</a>!');
        $class = 'er';
    }elseif($post['errcode'] == '2') {
        $msg = $post['msg'];
        $class = 'un';
    }else {
        $msg = $post['msg'];
        $class = 'un';
    }
}else {
    $msg = _l('Wrong request!');
    $class = 'er';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo _l('Register Response!'); ?></title>
        <style type="text/css">
            body	{ margin: 0; padding: 0; color: #333; font-size:16px; font-family: <?php echo _l("'Arial',sans-serif")?>; background-color: #f3f3f3; background: transparent;}
            a   { color:#E83228;}
            a:hover	{ color:#009;}
            #wrap	{ margin: 10px auto; width:430px; padding:10px; background-color: #fff;  -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius: 5px; border-radius: 5px; height:430px; overflow:hidden;}
            #wrap_mask  { margin: 0 auto; width:470px; height:470px; background-color: #83D4EA; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius: 5px; border-radius: 5px; position:absolute; top:0px; z-index:-1; margin-left:-235px; left:50%; opacity:0.5; filter:alpha(opacity=40); }
            #msg    { font-size:24px; text-align: center; margin-top:30px; }
            #msg.ok { color:#090;}
            #msg.er { color:#900;}
            #msg.un { color:#000;}
        </style>
    </head>
    <body>
        <div id="wrap">
            <div id="msg" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
            <div style="margin-top:30px; text-align: left; font-size: 20px;"><?php echo _l('Twitter clients avliable:'); ?></div>
            <ul style="margin-top:10px; text-align: left;">
                <li><a href="http://br.st" target="_blank">br.st</a>  Twitter client</li>
                <li><a href="http://brizzly.com/" target="_blank">brizzly.com</a>  Twitter client</li>
                <li><a href="https://zdx.in/" target="_blank">zdx.in</a>  Twitter client</li>
                <li><a href="https://twfav.com/" target="_blank">twfav.com</a>  Twitter favorites</li>
            </ul>
        </div>
        <div id="wrap_mask"></div>
    </body>
    <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        try {
            var pageTracker = _gat._getTracker("UA-11833635-2");
            pageTracker._trackPageview();
        } catch(err) {}</script>
</html>
