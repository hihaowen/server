<?php

/*
appid wxa1da1705feafe4fd
appsecret e94dafe02d083e277bc01ecf3f0859f1


1、获取code
https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=
code&scope=snsapi_userinfo&state=STATE#wechat_redirect

如果用户同意授权，页面将跳转至 redirect_uri/?code=CODE&state=STATE

2、获取access_token
https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code

3、刷新access_token
https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token=REFRESH_TOKEN

4、获取用户信息
https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
*/

$_SERVER['SERVER_NAME'] = 'api.ltwen.com';

CONST APP_ID = 'wxa1da1705feafe4fd';
CONST APP_SECRET = 'e94dafe02d083e277bc01ecf3f0859f1';


//获取code
if( isset($_GET['code']) && isset($_GET['state']) ) {
    $code = $_GET['code'];
    $state = $_GET['state'];

    //获取access_token
    $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='. APP_ID .'&secret=' . APP_SECRET . '&code=' . $code . '&grant_type=authorization_code';
    $res = getRes($url);
    $res_arr = json_decode($res, true);
    if( isset($res_arr['errcode']) ){
        echo '获取access_token失败:' . $res_arr['errmsg'];
        exit;
    }else{
        $access_token = $res_arr['access_token'];
        $openid = $res_arr['openid'];
        $refresh_token = $res_arr['refresh_token'];
        //获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $res = getRes($url);
        $res_arr = json_decode($res, true);

        if( isset($res_arr['errcode']) ) {
            echo '获取用户信息失败:' . $res_arr['errmsg'];
            exit;
        }else{
            //fetch ok
            header("Content-type: text/html; charset=utf-8");
            echo '<pre>';
            print_r($res_arr);
            echo '</pre>';
            exit;
        }
    }

} else {
    $redirect_uri = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $redirect_uri = urlencode($redirect_uri);
    $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . APP_ID . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
    echo <<<HTML
<html>
<head>
    <title>微信授权测试</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
</head>
<body>
    <button type="button" onclick="window.location.href = '{$url}';">微信授权测试</button>
</body>
</html>
HTML;

}

function getRes($url){
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if(curl_errno($ch)){
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);

        return $res;

    } catch (\Exception $e) {
        echo 'Curl error: ' . $e->getMessage();
        exit;
    }
}
