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
    <form if="form" action="http://max.com:666/Maxfirstone/fullStack/CRUD/新增資料.php" method="POST" align="center">
      選擇資料庫：<select name="DBSelect">
        <option value="雇員資料">雇員資訊</option>
        <option value="書籍資料">書籍資料</option>
      </select><br>
      <input type="submit" value="送出" id="submit">
    </form>
    <form action="http://max.com:666/Maxfirstone/fullStack/CRUD/新增資料.php" method="post" align="center">
      <?
$Create = new Create;
$Create->from();
?>
      <input type="hidden" name="<?$Create->save()?>" value="add">
      <input type="submit" name="button" value="新增資料">
      <input type="reset" name="button2" value="重新填寫">
    </form>
    <?$Create->save();?>
  </div>
</body>

</html>

<?php
class Create
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
        echo "<input type=" . "hidden" . " name=" . " DBSelect" . " value=" . $connDB . ">";
        $input = $result->result_metadata();
        while ($inputMeta = $input->fetch_field()) {
            if ($inputMeta->flags == 49667) {
                continue;
            }
            echo "<tr text-align=center>";
            echo "<th>" . $inputMeta->name . "</th>";
            echo "<td><input type=" . $dataType[$inputMeta->type] . " name=" . $inputMeta->name . " required></td>";
            echo "</tr>";
        }
        echo "</table></p>";
        $input->close();
        $conn->close();
    }
    public function save()
    {
        if (!isset($_POST["action"]) or !$_POST["action"] == "add") {
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