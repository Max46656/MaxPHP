<?php

echo "
<script>
function delall() {
  console.log('delall');
  if (confirm('\\n是否要刪除這筆資料?\\n刪除後無法恢復喔!\\n')) {
    form1.submit();
  } else {
    return false;
  }
}
</script>
";

echo "
<style>
  table,td{
    border-collapse:collapse;
  }
</style>

";

//引入在最上面或是這裡都可以，單純習慣放html下方
require_once "connDB.php";

$sql = "select * from `members` ";
$result = mysqli_query($conn, $sql);
$record = mysqli_num_rows($result);

$per_page = 10;
$total_page = ceil($record / $per_page);

if (isset($_GET['page'])) {
    $page = intVal($_GET['page']);
} else {
    $page = 1;
}
$start = ($page - 1) * $per_page;

$sql = "select * from `members` limit $start,$per_page";
$result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// $record=$result->num_rows;
// $record = mysqli_num_rows($result);

echo "<form align='center' action='delete_all.php' name='form1' method='POST'>";
echo "
<h1 align='center'>會員資料管理系統</h1>
<p align='center' >總共幾:{$record}筆資料，目前在第{$page}頁</P>
<p align=\"center\" >
  <a href='create.php'>新增會員資料</a>&emsp;
  <a href=\"#\" onclick='delall();'>刪除被選取的資料</a>&emsp;

</P>


";

//資料內容呈現
echo "
<p>
  <table align=center border=1>";

echo "<tr>
  <th>會員編號</th>
  <th>會員姓名</th>
  <th>暱稱</th>
  <th>密碼</th>
  <th>性別</th>
  <th>生日</th>
  <th>群組</th>
  <th>電子郵件</th>
  <th>網址</th>
  <th>電話</th>
  <th>地址</th>
  <th>是否登入</th>
  <th>建立時間</th>
  <th>登入時間</th>
  <th colspan='3'>功能</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    # code...

    echo "
    <tr align=center>
        <td>{$row['m_id']}</td>
        <td>{$row['m_name']}</td>
        <td>{$row['m_username']}</td>
        <td>{$row['m_password']}</td>
        <td>{$row['m_sex']}</td>
        <td>{$row['m_birthday']}</td>
        <td>{$row['m_level']}</td>
        <td>{$row['m_email']}</td>
        <td>{$row['m_url']}</td>
        <td>{$row['m_phone']}</td>
        <td>{$row['m_address']}</td>
        <td>{$row['m_login']}</td>
        <td>{$row['m_logintime']}</td>
        <td>{$row['m_jointime']}</td>
        <td><a href='update.php?m_id={$row["m_id"]}'>修改</a></td>
        <td><a href='delete.php?m_id={$row["m_id"]}'>刪除</a></td>
        <td><input type='checkbox' name='del[]' value='{$row['m_id']}'></td>
      </tr>";
}
echo "
  </table>
</p>";

echo "</form>";

echo "<table align='center'>";
echo "<tr>";
echo "<td>";

$prev = $page - 1;
$next = $page + 1;

if ($page == 1) {
    echo "<a style=\"pointer-events:none;\" href='?page=1'>首頁</a>";
} else {
    echo "<a href='?page=1'>首頁</a>
    <a href='?page=$prev'>上一頁</a>";
}

if ($page == $total_page) {
    echo "<a style=\"pointer-events:none;\"  href='?page=$total_page'>尾頁</a>";
} else {
    echo "<a href='?page=$next'>下一頁</a>
    <a href='?page=$total_page'>尾頁</a>";

}

echo "</table>";
echo "</tr>";
echo "</td>";

mysqli_free_result($result);
mysqli_close($conn);

echo "<br>";
