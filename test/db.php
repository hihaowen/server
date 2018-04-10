<?php
/**
 * Filename: db.php.
 * User: George
 * Date: 2018/4/10
 * Time: 下午2:33
 */

$host = 'sql12.freemysqlhosting.net';
$user = 'sql12231770';
$pass = '8XmTZQVLKu';
$db_name = 'sql12231770';
$port = 3306;

$db = new mysqli();

@ $db->connect($host, $user, $pass, $db_name, $port);

if($db->connect_errno) {
    die('Connect Error: ' . $db->connect_error . ', Errno: ' . $db->connect_errno);
}

$db->set_charset('utf8');

/*
$result = $db->query('CREATE TABLE `tab1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT \'\',
  `cnt` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

for($i = 0; $i < 1000; $i++) {
    $db->query("insert into tab1 values(null, '" . mt_rand(1, 1000) . "', " . mt_rand(1, 1000) . ")");
}
*/

$result = $db->query('show full processlist');

if( $db->errno ) {
    die('Query Error: ' . $db->error . ', Errno: ' . $db->errno);
}

while( $assoc = mysqli_fetch_assoc($result) ) {
    print_r($assoc);
}

// $db->close();
