<?php
/**
 * Filename: db.php.
 * User: George
 * Date: 2018/4/10
 * Time: 下午2:33
 */

$host = 'dev1.office-public.tengyue360.com';
$user = 'root';
$pass = 'TengYue360!';
$db_name = 'test';
$port = 3306;

$db = new mysqli();

$db->connect($host, $user, $pass, $db_name, $port);

if($db->connect_errno) {
    die('Connect Error: ' . $db->connect_error . ', Errno: ' . $db->connect_errno);
}

$db->set_charset('utf8');

$result = $db->query('select * from tab1 limit 1');

if( $db->errno ) {
    die('Query Error: ' . $db->error . ', Errno: ' . $db->errno);
}

$arr = mysqli_fetch_assoc($result);

print_r($arr);

// $db->close();
