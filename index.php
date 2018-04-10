<?php
/*****************************************************************
 * Copyright (C) 2018 Ltwen.com. All Rights Reserved.
 * Licensed http://www.apache.org/licenses/LICENSE-2.0
 * 文件名称：index.php
 * 创 建 者：hwz <haowen.hi@gmail.com>
 * 创建日期：2018年01月13日 17:44:21
 ****************************************************************/

error_reporting(E_ALL);
// error_reporting(0);

define('ROOT_PATH', dirname(__FILE__));

// var_dump($_SERVER['SERVER_ENV_TAG']);
$request_uri = $_SERVER['REQUEST_URI'];
$uri_args = parse_url($request_uri);
$path = $uri_args['path'] ?: '/';

$path_arr = explode('/', $path);

//useless path
array_shift($path_arr);

$base_path = array_shift($path_arr);
$file_name = array_shift($path_arr);
if( $file_name ) {
    $file_name .= '.php';
}

$class_file = ROOT_PATH . '/' . $base_path . '/' . $file_name;

if( !file_exists($class_file) ) {
    die('uri is not exists.');
}

require_once($class_file);
