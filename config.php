<?php
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Manila');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$db_name = "abukai_db";
$db_pass = "root";
$db_user = "root";
$db_host = "127.0.0.1";

try {
    global $db_conn;
    $db_conn= new PDO("mysql:host=$db_host:8889;dbname=$db_name", "$db_user", "$db_pass");
    $db_conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection Failed to DCRM: ".$e->getMessage();
    die();
}
?>