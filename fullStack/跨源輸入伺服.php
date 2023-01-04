<?php
header('Access-Control-Allow-Origin: http://max.com:666');
//只允許 http://max.com:666 CROS
// header('Access-Control-Allow-Origin: *');  // 允許 任何網站 CROS
// header('Access-Control-Allow-Credentials:true');  //以cookie判斷

$uname = $_POST["username"];
$upass = $_POST["password"];

if ($uname == "Max" && $upass == "123") {
    // time() + 24 * 60 * 60->一天內失效。
    setcookie('username', $uname, time() + 24 * 60 * 60);
    setcookie('password', $upass, time() + 24 * 60 * 60);
    //echo "登入成功";
    $success = ['msg' => 'OK', 'info' => 'hello'];
    echo json_encode($success);
} else {
    $success = ['msg' => 'FAIL', 'info' => 'hello'];
    echo json_encode($success);
}