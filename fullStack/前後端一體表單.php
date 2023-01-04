<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div id="main">
    <form name="form1" action="http://max.com:666/Maxfirstone/前後端一體表單.php" method="get" align="left">
      使用者: <input type="text" name="UserId"><br>
      郵件: <input type="email" name="UserEmail"><br>
      學歷: <select name="UserEdu">
        <option value="E">國小</option>
        <option value="S">國中</option>
        <option value="JH">高中</option>
        <option value="C">大學</option>
        <option value="其他">其他</option>
      </select><br>
      喜好:
      <input type="checkbox" name="SubC[]" value="吃">吃<br>
      &emsp;&emsp;&nbsp;<input type="checkbox" name="SubC[]" value="喝">喝<br>
      &emsp;&emsp;&nbsp;<input type="checkbox" name="SubC[]" value="玩">玩<br>
      &emsp;&emsp;&nbsp;<input type="checkbox" name="SubC[]" value="樂">樂<br>

      <input type="reset" value="取消"><input type="submit" value="送出">
    </form>
  </div>
</body>

</html>


<?php

//執行時機
if (
    isset($_GET['UserId']) and isset($_GET['UserEmail']) and isset($_GET['UserEdu']) and
    isset($_GET['SubC'])
    and !empty($_GET['UserId']) and !empty($_GET['UserEmail']) and !empty($_GET['UserEdu']) and !empty($_GET['SubC'])
) {

    //取得前台的資料
    $UserId = $_GET["UserId"];
    $email = $_GET["UserEmail"];
    $edu = $_GET["UserEdu"];
    $SubC = $_GET["SubC"];

    //法1:
    // foreach ($SubC as $Sub) {
    //   echo $Sub . "<br>";
    // }

    //法2:
    // echo implode(",", $SubC) .  "<br>";
    $h = implode(",", $SubC);

    echo "使用者是: {$UserId} 他的郵件是: {$UserEmail} <br> 學歷是: {$edu} 是嗜好有 : {$h}";

}