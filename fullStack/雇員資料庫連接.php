<?
$user = "Max";
$password = "SAYWHAT";
$host = "localhost";
$db = "ch08";
$port = "3306";
$conn = new mysqli($host, $user, $password, $db, $port);
$title = "雇員管理";
$table = "`employee`";
$col = ['員工編號', '姓名', '性別', '電話', '主管編號'];
