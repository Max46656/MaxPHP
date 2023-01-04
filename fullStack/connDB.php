<?php

$user = "root";
$password = "1qaz@wsx";
$host = "localhost";
$db = "member";
$port = "3306";

//第一種連線方式
// $conn = mysqli_connect($host, $user, $password, $db, $port);
//第二種連線方式

try {
    $conn = mysqli_connect($host, $user, $password);
    // echo "<pre>";
    // print_r($conn);
    if ($conn) {
        mysqli_select_db($conn, $db);
        mysqli_query($conn, 'set names utf8');
        mysqli_set_charset($conn, 'utf8');
    }
} catch (Exception $e) {
    echo "資料庫連線失敗" . $e->getMessage() . "\n";
}