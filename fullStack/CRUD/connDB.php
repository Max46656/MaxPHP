<?php

$br = " <br> ";

// $user = "root";
// $password = "1qaz@wsx";
// $host = "localhost";
// $db = "class";
// $port = "3306";
// $conn1 = mysqli_connect($host, $user, $password, $db, $port);

$user = "root";
$password = "1qaz@wsx";
$host = "localhost:3306";
$db = "members";
$conn = mysqli_connect($host, $user, $password);
if ($conn) {
    mysqli_select_db($conn, $db);
    mysqli_query($conn, "set names utf8");
    mysqli_set_charset($conn, "utf8");

} else {
    echo "資料庫連線失敗";
}