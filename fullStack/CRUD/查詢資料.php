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

  <div id="main">
    <form id="formR" action="http://max.com:666/Maxfirstone/fullStack/CRUD/查詢資料.php" method="get" align="center">
      資料庫選擇：<select name="DBSelect">
        <option value="雇員資料">雇員資訊</option>
        <option value="書籍資料">書籍資料</option>
      </select><br>
      <input type="submit" value="送出" id="submit">
      <?$Read = new Read;?>
      <?$Read->from();?>
    </form>
    <?$Read->pageUrl();?>
  </div>
</body>

</html>

<?php
class Read
{
    public function select()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conDB = $_GET['DBSelect'];
        require "$conDB.php";
        $conn = new mysqli($host, $user, $password, $db);
        $page = $this->page();
        $start = $page["start"];
        $per_page = $page["per_page"];
        $sql = "SELECT * FROM $table LIMIT {$start},{$per_page}";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    public function from()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conDB = $_GET['DBSelect'];
        require "$conDB.php";
        $page = $this->page();
        $result = $this->select();
        echo "
        <style>table,td{
          border-collapse:collapse;
        }</style>
        <h1 align='center'>$title</h1>";
        echo "<p align=center>目前{$conDB}數量為：" . $page['record'] . " 目前在第" . $page['page'] . "頁</p>";
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
    }
    public function page()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conDB = $_GET['DBSelect'];
        require "$conDB.php";
        $record = $this->select()->num_rows;
        $total_page = ceil($record / $per_page);
        $prev = $page - 1;
        $next = $page + 1;
        if (isset($_GET['page'])) {
            $page = intVal($_GET['page']);
        } else {
            $page = 1;
        }
        $per_page = 6;
        $start = ($page - 1) * $per_page;
        $page = ["per_page" => $per_page, "start" => $start, "total_page" => $total_page, "record" => $record, "page" => $page];
        return $page;
    }
    public function pageUrl()
    {
        if ($page > 1) {
            echo "<div align=center><a href='?DBSelect=$conDB&page=1'>首頁</a>&emsp;<a href='?DBSelect=$conDB&page=$prev'>上一頁</a>&emsp;</div>";
        }
        if ($page < $total_page) {
            echo "<div align=center><a href='?DBSelect=$conDB&page=$next'>下一頁</a>&emsp;<a href='?DBSelect=$conDB&page=$total_page'>末頁</a></div>";
        }
        $conn->close();
    }
}