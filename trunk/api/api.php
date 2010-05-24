<?php
/*
 * Twreg API class
 *
 * method: recaptcha
 * method: authkey
 * method: valid_email
 * method: valid_username
 * method: create type: post
 *
 * Developed by @hfcorriez at 11/21/2009
 *
*/


class API {
    const TWITTER_URL = 'https://twitter.com/';
    protected $output_method = 'output';
    protected $language = 'zh-cn';
    protected $_lang = array();
    protected $data_type = 'json';

    function  __construct($language= 'zh-cn',$data_type = 'json', $output_method = 'output') {
        $language && $this->language = $language;
        $output_method && $this->output_method = $output_method;
        $data_type && $this->data_type = $data_type;
    }

    function recaptcha() {
        $file = file_get_contents('http://www.google.com/recaptcha/api/challenge?k=6LfbTAAAAAAAAE0hk8Vnfd1THHnn9lJuow6fgulO&lang=en');
        $pattern1 = "/challenge ?\: ?'([\w_\-]+)',/";
        $pattern2 = "/server ?\: ?'(.*?)'/";
        preg_match($pattern1, $file, $matches1);
        preg_match($pattern2, $file, $matches2);
        $array = array();
        $challenge = $matches1[1];
        $server = $matches2[1];
        $imgurl = API_URL . 'captcha.php?c='. $challenge . '&s=' . $server;
        $imgquery = '?c='. $challenge . '&s=' . $server;
        if(!$challenge) {
            $arr['msg'] = $this->_l('Get recaptcha code fail!');
            $arr['data'] = '';
            $arr['image'] = '';
            $arr['query'] = '';
        }else {
            $arr['msg'] = $this->_l('Get recaptcha code ok!');
            $arr['data'] = $challenge;
            $arr['image'] = $imgurl;
            $arr['query'] = $imgquery;
        }
        return $this->output($arr);
    }

    function authkey() {
        $url = self::TWITTER_URL . 'signup';
        $data = $this->http($url);
        $auth_key = $this->cutstr($data['response'], '<input name="authenticity_token" type="hidden" value="', '" />');
        if(!$auth_key) {
            $arr['msg'] = $this->_l('Get authorized key fail!');
            $arr['data'] = '';
        }else {
            $arr['msg'] = $this->_l('Get authorized ok!');
            $arr['data'] = $auth_key;
        }
        return $this->output($arr);
    }

    function valid_email($s) {
        if($s) {
            $url = self::TWITTER_URL . 'users/email_available?email=' . urlencode($s);
            $data = $this->http($url);
            $array = (array)json_decode(stripslashes($data['response']));
            //var_dump($array);
            $arr['msg'] = $this->_l($array['msg']);
            $arr['valid'] = $array['valid'];
            return $this->output($arr);
        }
        return false;
    }

    function valid_username($s) {
        if($s) {
            $url = self::TWITTER_URL . 'users/username_available?username=' . urlencode($s);
            $data = $this->http($url);
            $array = (array)json_decode(stripslashes($data['response']));
            $arr['msg'] = $this->_l($array['msg']);
            $arr['valid'] = $array['valid'];
            return $this->output($arr);
        }
        return false;
    }

    function create($_POST) {
        $postData['user[name]'] = $_POST['name'];
        $postData['user[screen_name]'] = $_POST['screen_name'];
        $postData['user[email]'] = urlencode($_POST['email']);
        $postData['user[user_password]'] = $_POST['password'];
        $postData['user[send_email_newsletter]'] = 0;
        $postData['recaptcha_response_field'] = $_POST['recaptcha_response'];
        $postData['recaptcha_challenge_field'] = $_POST['recaptcha_challenge'];
        $postData['authenticity_token'] = $_POST['authenticity_token'];
        $post = $this->http(self::TWITTER_URL . 'account/create', $postData);
        if($post['http_code']>300 && $post['http_code']<400) {
            $arr['msg'] = sprintf($this->_l('Hello, %s!<br/ >  Register success! Welcome to Twitter, Please check your email! Or you can login with your Twitter account.'), $_POST['screen_name']);
            $arr['success'] = 'true';
            $arr['errcode'] = '0';
        }elseif($post['http_code']==200) {
            $arr['msg'] = $this->_l('Some error occured!');
            $arr['success'] = 'false';
            $arr['errcode'] = '1';
        }else {
            $arr['msg'] = $this->_l('Client time out!');
            $arr['success'] = 'false';
            $arr['errcode'] = '2';
        }
        if($_POST['debug'] == 'true') {
            echo $post['response'];
        }
        return $this->output($arr);
    }

    function output($arr = array()) {
        if($this->output_method == 'output') {
            if($this->data_type == 'json') {
                echo json_encode($arr);
            }elseif($this->data_type=='serialize') {
                echo serialize($arr);
            }
            return true;
        }else {
            return $arr;
        }
    }

    protected function cutstr($str, $strStart, $strEnd) {
        $posStart = strpos($str, $strStart);
        $posEnd = strpos($str, $strEnd, $posStart);
        return substr($str, $posStart + strlen($strStart), $posEnd - $posStart - strlen($strStart));
    }

    protected function http($url, $post_data = null) { /*{{{*/
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

    function _l($key) {
        if(!$this->_lang) {
            $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR. $this->language . '.php';
            file_exists($file) && $this->_lang = include($file);
        }
        if(isset($this->_lang[$key]))
            return $this->_lang[$key];
        else
            return $key;
    }
}
?>