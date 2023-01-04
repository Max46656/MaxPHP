<?php

require_once "connDB.php";

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $sql_update = "
UPDATE `members` SET
  `m_name`='%s',
  `m_username`='%s',
  `m_password`='%s',
  `m_sex`='%s',
  `m_birthday`='%s',
  `m_level`='%s',
  `m_email`='%s',
  `m_url`='%s',
  `m_phone`='%s',
  `m_address`='%s',
  `m_login`='%s'
  WHERE m_id=%s
  ";
    $sql_update = sprintf($sql_update,
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
        $_POST['m_login'],
        $_POST['m_id'],
    );
    // echo $sql_update;
    mysqli_query($conn, $sql_update);
    mysqli_close($conn);
    header("location:index.php");
}

$sql_db = "select * from `members` where `m_id`={$_GET['m_id']}";
$result = mysqli_query($conn, $sql_db);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);

mysqli_close($conn);

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
  <h1 align='center'>會員資料管理系統 - 修改資料</h1>
  <p align='center'><a href='index.php'>回主畫面</a></p>
  <form action='update.php' method='POST' name='formUpdate'>
    <table border='1' align='center' cellpadding=4>
      <tr>
        <th>欄位</th>
        <th>資料</th>
      </tr>
      <tr>
        <td>會員姓名</td>
        <td><input type='text' name='m_name' required value="<?=$row['m_name']?>"></td>
      </tr>
      <tr>
        <td>暱稱</td>
        <td><input type='text' name='m_username' required value="<?=$row['m_username']?>"></td>
      </tr>
      <tr>
        <td>密碼</td>
        <td><input type='text' name='m_password' required value="<?=$row['m_password']?>"></td>
      </tr>
      <tr>
        <td>性別</td>
        <td>
          <input type='radio' name='m_sex' value='男' <?php if ($row['m_sex'] == '男') {
    echo " checked";}?>>男
          <input type='radio' name='m_sex' value='女' <?php if ($row['m_sex'] == '女') {
    echo " checked";}?>>女
        </td>
      </tr>
      <tr>
        <td>生日</td>
        <td><input type='date' name='m_birthday' required value="<?=$row['m_birthday']?>"></td>
      </tr>
      <tr>
        <td>群組</td>
        <td>
          <input type='radio' name='m_level' value='admin' <?php if ($row['m_level'] == 'admin') {
    echo " checked";}?>>admin
          <input type='radio' name='m_level' value='member' <?php if ($row['m_level'] == 'member') {
    echo " checked";}?>>member
        </td>
      </tr>
      <tr>
        <td>電子郵件</td>
        <td><input type='email' name='m_email' required value="<?=$row['m_email']?>"></td>
      </tr>
      <tr>
        <td>網址</td>
        <td><input type='text' name='m_url' size='40' required value="<?=$row['m_url']?>"></td>
      </tr>
      <tr>
        <td>電話</td>
        <td><input type='tel' name='m_phone' required value="<?=$row['m_phone']?>"></td>
      </tr>
      <tr>
        <td>住址</td>
        <td><input type='text' name='m_address' size='40' required value="<?=$row['m_address']?>"></td>
      </tr>
      <tr>
        <td>是否登入</td>
        <td>
          <input type='radio' name='m_login' value='1' <?php if ($row['m_login'] == '1') {
    echo " checked";}?>>是
          <input type='radio' name='m_login' value='0' <?php if ($row['m_login'] != '1') {
    echo " checked";}?>>否
        </td>
      </tr>
      <tr>
        <td colspan='2' align='center'>
          <input type='hidden' name='m_id' value="<?=$row['m_id']?>">
          <input type='hidden' name='action' value='update'>
          <input type='submit' name='btnAdd' value='修改資料'>
          <input type='reset' name='btnCancel' value='取消'>
        </td>
      </tr>
    </table>

  </form>


</body>

</html>