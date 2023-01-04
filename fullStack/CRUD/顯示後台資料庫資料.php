<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="menu and sub menu from Voyager">
  <meta name="color-scheme" content="dark">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>公司資料管理</title>
</head>

<body>
  <br><br><br><br><br><br>
  <div id="main">
    <form id="form1" action="http://max.com:666/Maxfirstone/fullStack/顯示後台資料庫資料.php" method="get" align="center">
      查詢資料：<select name="DBSelect">
        <option value="雇員資料">雇員資訊</option>
        <option value="書籍資料">書籍資料</option>
      </select><br>
      <input type="submit" value="送出" id="submit">
    </form>
  </div>
</body>

</html>

<?php

if (!isset($_GET['DBSelect'])) {
    exit;
}
$conDB = $_GET['DBSelect'];
require "$conDB.php";
echo "
<style>table,td{
    border-collapse:collapse;
}</style>
<h1 align='center'>$title</h1>";

$sql = "SELECT * FROM" . $table;
$result = $conn->query($sql);
echo "<p align=center>目前" . $conDB . "數量為：" . $result->num_rows;
echo "<p><table align=center border=1>";
echo "<tr>";
foreach ($colName as $key => $value) {
    echo "<th>$value</th>";
}
echo "</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr align=center>";
    foreach ($row as $key => $value) {
        echo "<td>" . $value . "</td>";
    }
}
echo "</table></p>";
$conn->close();