<!DOCTYPE html>
<html lang="zh-tw">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="CRUD-C From">
  <meta name="color-scheme" content="light">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>PDO_CRUD_C</title>
</head>

<body>
  <?require_once "connDB.php";?>
  <?$connDB = new connDB;?>
  <?$Create = new Create($connDB);?>
  <div id="main">
    <h1>
      <?echo $Create->title(); ?>
    </h1>
    <?echo $Create->success(); ?>
    <br>
    <form id="DBform" action="http://max.com:666/Maxfirstone/fullStack/PDOCRUD/create.php" method="GET" align="center">
      資料表選擇：<select name="DBSelect">
        <?echo $Create->DBSelect(); ?>
      </select><br>
      <?echo $Create->save(); ?>
      <input type="submit" value="送出" class="commit">
    </form>
    <form id="formC" action="http://max.com:666/Maxfirstone/fullStack/PDOCRUD/create.php" method="POST">
      <table class="DBTable">
        <tbody>
          <?echo $Create->fromInput(); ?>
        </tbody>
      </table>
      <div>
        <input type="hidden" name="action" value="add">
        <input type='submit' name='button' value='新增資料' class='commit'>
        <?echo $Create->submitDB(); ?>
      </div>
    </form>
  </div>
</body>

</html>

<?php

use grammar\Inflect;

class Create
{
    protected static $connDB;
    protected $tblNames;
    protected $fieldMeta;

    public function __construct(connDB $connDB)
    {
        require 'Inflect.php';
        self::$connDB = $connDB->ConnDB();
        $this->tblNames = $connDB->tblName();
        $this->fieldMeta = $connDB->fieldMeta();
        $connDB = null;
    }
    public function success()
    {
        if (isset($_GET['success'])) {
            return "新增資料成功";
        }
    }
    public function title()
    {
        if (!isset($_GET['DBSelect'])) {
            return "專案資料";
        }
        $title = mb_convert_case($_GET['DBSelect'], MB_CASE_TITLE, "UTF-8");
        $title = $this->Singular($title);
        return $title;
    }
    protected function Singular($String)
    {
        $SingularString = Inflect::singularize($String);
        return $SingularString;
    }
    public function DBSelect()
    {
        $tblNames = $this->tblNames;
        $htmlTag = "";
        foreach ($tblNames as $key => $value) {
            $htmlTag .= "<option value=" . $value . ">" . $value . "</option>";
        }
        return $htmlTag;
    }
    // public function fromTitle()
    // {
    //     if (!isset($_GET['DBSelect'])) {
    //         exit;
    //     }
    //     $conn = new connDB;
    //     $result = $conn->fieldMeta();
    //     $htmlTag = "";
    //     $noID = array_shift($result);
    //     foreach ($result as $key => $value) {
    //         $htmlTag .= "<tr><th>$key</th></tr>";
    //     }
    //     $conn = null;
    //     return $htmlTag;
    // }
    public function fromInput()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $result = $this->fieldMeta;
        $htmlTag = "";
        if (isset($result['id'])) {
            array_splice($result, 0, 1);
        }
        if (isset($result['created_at'])) {
            array_splice($result, -2);
        }
        foreach ($result as $key => $value) {
            if ($value == "hidden" or $key == "mode") {
                continue;
            }
            $htmlTag .= "<tr><th>$key</th>";
            // 以下4選項出於原資料表未補全而補充的欄位，應在資料庫中正確填寫以保持程式可讀性。
            // if ($key == "email") {
            //     $htmlTag .= "<td><input type='$key' name='$key' placeholder='$key'></td></tr>";
            //     continue;
            // }
            // if ($key == "fb_id") {
            //     $htmlTag .= "<td><input type='url' name='$key' placeholder='https://example.com'></td></tr>";
            //     continue;
            // }
            // if ($key == "birthday") {
            //     $htmlTag .= "<td><input type='date' name='$key' placeholder='$key'></td></tr>";
            //     continue;
            // }
            // if ($key == "tel") {
            //     $htmlTag .= "<td><input type='tel' name='$key' placeholder='$key'></td></tr>";
            //     continue;
            // }
            if ($value == "text_area") {
                $htmlTag .= "<td><textarea name='$key' rows='6' cols='21' placeholder='$value'></textarea></td></tr>";
                continue;
            }
            if ($value == "checkbox") {
                $htmlTag .= "<td><label class='button_cover'>
                <input class='button_input' type='checkbox' name='$key' value='$value'>
                <span class='button_icon'>(･ω´･ )つ啟用</span>
                </label></td></tr>";
                continue;
            }
            if ($key == "pic" or $key == "icon" or $key == "pics" or $value == "image") {
                $htmlTag .= "<td><label class='button_cover'>
                <input class='button_input' type='file' accept='.jpg, .jpeg, .png, .tiff, .bmp, .gif,'>
                <span class='button_icon'>(つ´ω`)つ點我</span>
                </label></td></tr>";
                continue;
            }
            $htmlTag .= "<td><input type='$value' name='$key' placeholder='$value'></td></tr>";
        }
        return $htmlTag;
    }
    public function submitDB()
    {
        $htmlTag = "<input type='hidden' name='DBSelect' value='{$_GET["DBSelect"]}'>";
        return $htmlTag;
    }
    public function save()
    {
        if (isset($_POST["action"])) {
            $conn = self::$connDB;
            $table = array_pop($_POST);
            array_splice($_POST, -2);
            $sql = "SET FOREIGN_KEY_CHECKS=0;";
            $sql .= "INSERT INTO" . "`$table`(";
            foreach ($_POST as $key => $value) {
                $sql .= "`$key`,";
            }
            $sql = chop($sql, ",");
            $sql .= ") VALUES(";
            foreach ($_POST as $key => $value) {
                $sql .= "'$value',";
            }
            $sql = chop($sql, ",");
            $sql .= ");";
            $sql .= "SET FOREIGN_KEY_CHECKS=1;";
            try {
                $result = $conn->prepare($sql);
                $result->execute();
                $conn = null;
                header("Location:http://max.com:666/Maxfirstone/fullStack/PDOCRUD/create.php?DBSelect={$table}&success");
            } catch (PDOException $e) {
                $conn = null;
                die("<span class=errorMessage>" . "ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "</span><br/>");
            }
        }
    }
}

?>