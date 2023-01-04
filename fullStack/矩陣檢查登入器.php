<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>矩陣登入器</title>
</head>

<style>
div.FromUser {
  text-align: center;
}

div.WrongUser {
  text-align: center;
  color: crimson;
}
</style>



<body>
  <div class="FromUser">
    <form action="矩陣檢查登入器.php
" method="post" id="UserFrom">
      使用者名稱<input type="email" name="UserId" id=""><br>
      使用者密碼<input type="password" name="UserPW" id=""><br>
      請輸入1 <input type="number" name="UserN" id=""><br>
      <input type="submit" value="送出">
      </from>
  </div>
</body>

</html>

<?php
if (empty($_POST['UserId']) || empty($_POST['UserPW']) || empty($_POST['UserN'])) {
    return;
}

$UserAll = ["Max@mail.com" => ['123' => 1],
    "User@mail.com" => ["User" => 1]];

if (!$_POST['UserId'] || !$_POST['UserPW']) {
    echo "<div class='WrongUser'>請輸入使用者資訊</div>";
} else {
    $UserId = $_POST['UserId'];
    $UserPW = $_POST['UserPW'];
    $UserN = $_POST['UserN'];
    $UserCount = 0;
    foreach ($UserAll as $key => $value) {
        if ($key == $UserId) {
            if ($UserAll[$UserId][$UserPW] == 1) {
                $UserAuth = true;
                break;
            }
        } else {
            if ($UserCount == count($UserAll)) {
                $UserAuth = false;
                echo "<div class='WrongUser'>使用者不相符</div>";
                echo count($UserAll);
                return;
            }
        }
        $UserCount += 1;
    }

}
// foreach ($UserAll as $key0 => $value) {
//     if ($key0 == $UserPW) {
//         foreach ($UserAll[$key0] as $key1 => $value) {
//             if ($key1 == $UserN) {
//                 $UserAuth = true;
//                 break;
//             }
//         }
//     } else {
//         $UserAuth = false;
//         echo "<div class='WrongUser'>使用者不相符</div>";
//         return;
//     }
// }
if ($UserAuth == true) {
    echo "<div>沒有未讀資訊</div>";
    echo "<script>
          document.getElementById('UserFrom').style.display = 'none';
          </script>";

} else {
    echo "<div class='WrongUser'>使用者不相符</div>";
    echo "<script>
          document.getElementById('UserFrom').style.display = 'none';
          </script>";
}
?>