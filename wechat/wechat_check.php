<?php

/*
signature	微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。
timestamp	时间戳
nonce	随机数
echostr	随机字符串
*/

if( isset($_GET['echostr']) ){
    echo $_GET['echostr'];
    exit;
}