<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="CRUD-C From">
  <meta name="color-scheme" content="dark">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>公司資料管理</title>
</head>

<body>
  <br><br><br><br><br><br>
  <div id="main">
    <form id="Dfrom" action="http://max.com:666/Maxfirstone/fullStack/CRUD/刪除資料.php" method="POST" align="center">
      選擇資料庫：<select name="DBSelect">
        <option value="雇員資料">雇員資訊</option>
        <option value="書籍資料">書籍資料</option>
      </select><br>
      <input type="submit" value="送出" id="submit">
    </form>
    <form action="http://max.com:666/Maxfirstone/fullStack/CRUD/刪除資料.php" method="POST" align="center">
      <?
$Delete = new Delete;
$Delete->from();
?>
      <input type="hidden" name="action" value="delete">
      <input type="submit" name="button" value="刪除資料">
      <input type="reset" name="button2" value="重新填寫">
    </form>
    <?$Delete->delete();?>
  </div>
</body>

</html>

<?php
class Delete
{
    public function from()
    {
        if (!isset($_POST['DBSelect'])) {
            exit;
        }
        $connDB = $_POST['DBSelect'];
        require "$connDB.php";
        echo "
        <style>table,td{
            border-collapse:collapse;
        }</style>
        <h1 align='center'>$title</h1>";

        $sql = "SELECT * FROM" . $table;
        $result = $conn->prepare($sql);
        $result->execute();
        echo "<p><table align=center border=1>";
        echo "<tr>";
        echo "<input type=hidden" . " name=" . " DBSelect" . " value=" . $connDB . ">";
        $input = $result->result_metadata();
        $rowMeta = $input->fetch_assoc();
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr align=center>";
            foreach ($row as $key => $value) {
                echo "<td>" . $value;

            }
            echo "<input type=checkbox" . " name=" . $rowMeta->name . " value=" . $rowMeta->name . ">" . "</td>";

        }
        echo "</table></p>";
        $input->close();
        $conn->close();
    }
    public function delete()
    {
        if (!isset($_POST["action"]) or !$_POST["action"] == "delete") {
            exit;
        }
        $connDB = $_POST['DBSelect'];
        require "$connDB.php";
        $sqlSELECT = "SELECT * FROM" . $table;
        $result = $conn->prepare($sqlSELECT);
        $result->execute();
        $input = $result->result_metadata();
        array_splice($_POST, 0, 1);
        array_splice($_POST, -2);
        $sql = "INSERT INTO $table(";
        while ($inputMeta = $input->fetch_field()) {
            if ($inputMeta->flags == 49667) {
                continue;
            }
            $sql .= "`$inputMeta->name`,";
        }
        $sql = chop($sql, ",");
        $sql .= ") VALUES(";
        foreach ($_POST as $key => $value) {
            $sql .= "`$key`=" . "'" . $value . "',";
        }
        $sql = chop($sql, ",'");
        $sql .= "')";
        $result->close();
        $conn->query($sql);
        $conn->close();
    }
}
?>