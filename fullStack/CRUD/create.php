<?php

if (isset($_POST['m_name']) && !empty($_POST['m_name'])) {

    if (isset($_POST['action']) && $_POST['action'] == 'add') {

        require_once 'connDB.php';

        $sql_query = "
INSERT INTO `members`(
  `m_name`, `m_username`, `m_password`,
  `m_sex`, `m_birthday`, `m_level`,
  `m_email`, `m_url`, `m_phone`,
  `m_address`, `m_login`,  `m_jointime`)
  VALUES (
   '%s', '%s', '%s',
   '%s', '%s', '%s',
   '%s', '%s', '%s',
   '%s', '%s', NOW());
    ";
        $sql_query = sprintf($sql_query,
            $_POST['m_name'],
            $_POST['m_username'],
            $_POST['m_password'],
            $_POST['m_sex'],
            $_POST['m_birthday'],
            $_POST['m_level'],
            $_POST['m_email'],
            $_POST['m_url'],
            $_POST['m_phone'],
            $_POST['m_address'],
            $_POST['m_login']
        );
        echo $sql_query;
        mysqli_query($conn, $sql_query);
        mysqli_close($conn);
        header('location:index.php');

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1 align='center'>會員資料管理系統 - 新增資料</h1>
  <p align='center'><a href='index.php'>回主畫面</a></p>
  <form action='create.php' method='POST' name='formAdd'>
    <table border='1' align='center' cellpadding=4>
      <tr>
        <th>欄位</th>
        <th>資料</th>
      </tr>
      <tr>
        <td>會員姓名</td>
        <td><input type='text' name='m_name' required></td>
      </tr>
      <tr>
        <td>暱稱</td>
        <td><input type='text' name='m_username' required></td>
      </tr>
      <tr>
        <td>密碼</td>
        <td><input type='text' name='m_password' required></td>
      </tr>
      <tr>
        <td>性別</td>
        <td>
          <input type='radio' name='m_sex' value='男' checked>男
          <input type='radio' name='m_sex' value='女' checked>女
        </td>
      </tr>
      <tr>
        <td>生日</td>
        <td><input type='date' name='m_birthday' required></td>
      </tr>
      <tr>
        <td>群組</td>
        <td>
          <input type='radio' name='m_level' value='admin' checked>admin
          <input type='radio' name='m_level' value='member' checked>member
        </td>
      </tr>
      <tr>
        <td>電子郵件</td>
        <td><input type='email' name='m_email' required></td>
      </tr>
      <tr>
        <td>網址</td>
        <td><input type='text' name='m_url' size='40' required></td>
      </tr>
      <tr>
        <td>電話</td>
        <td><input type='tel' name='m_phone' required></td>
      </tr>
      <tr>
        <td>住址</td>
        <td><input type='text' name='m_address' size='40' required></td>
      </tr>
      <tr>
        <td>是否登入</td>
        <td>
          <input type='radio' name='m_login' value='1' checked>是
          <input type='radio' name='m_login' value='0' checked>否
        </td>
      </tr>
      <tr>
        <td colspan='2' align='center'>
          <input type='hidden' name='action' value='add'>
          <input type='submit' name='btnAdd' value='新增資料'>
          <input type='reset' name='btnCancel' value='取消'>
        </td>
      </tr>
    </table>

  </form>


</body>

</html>