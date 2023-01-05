<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="CRUD-C From">
  <meta name="color-scheme" content="light">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>專案資料管理</title>
</head>

<body>
  <?$Create = new Create;?>
  <div id="main">
    <h1>
      <?echo $Create->titleSingular(); ?>
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
class Create
{
    public function __construct()
    {
        require_once "connDB.php";
        require_once 'Inflect.php';
    }
    public function success()
    {
        if (isset($_GET['success'])) {
            return "新增資料成功";
        }
    }
    public function title()
    {
        $title = "新增";
        if (isset($_GET['DBSelect'])) {
            $title .= mb_convert_case($_GET['DBSelect'], MB_CASE_TITLE, "UTF-8");
        } elseif (isset($_POST['DBSelect'])) {
            $title .= mb_convert_case($_POST['DBSelect'], MB_CASE_TITLE, "UTF-8");
        } else {
            return "新增專案資料";
        }
        return $title;
    }
    public function titleSingular()
    {
        $title = $this->title();
        $titleSingular = Inflect::singularize($title);
        return $titleSingular;
    }
    public function DBSelect()
    {
        $conn = new connDB;
        $tblNames = $conn->tblName();
        $htmlTag = "";
        foreach ($tblNames as $key => $value) {
            $htmlTag .= "<option value=" . $value . ">" . $value . "</option>";
        }
        $conn = null;
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
        $conn = new connDB;
        $result = $conn->fieldMeta();
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
            if ($key == "pic" or $key == "icon" or $key == "pics" or $value == "image") {
                $htmlTag .= "<td><label class='upload_cover'>
                <input id='upload_input' type='file' accept='.jpg, .jpeg, .png, .bmp, .gif,' text-align: start;>
                <span class='upload_icon'>(つ´ω`)つ點我</span>
                </label></td>";
                continue;
            }
            if ($key == "pic" or $key == "icon" or $key == "pics" or $value == "image") {
                $htmlTag .= "<td><label class='upload_cover'>
                <input id='upload_input' type='file' accept='.jpg, .jpeg, .png, .bmp, .gif,' text-align: start;>
                <span class='upload_icon'>(つ´ω`)つ點我</span>
                </label></td>";
                continue;
            }
            $htmlTag .= "<td><input type='$value' name='$key' placeholder='$value'></td></tr>";
        }
        $conn = null;
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
            // if (!isset($_GET['DBSelect'])) {
            //     exit;
            // }
            $conn = new connDB;
            $conn = $conn->ConnDB();
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
            return var_dump($sql);
            try {
                $result = $conn->prepare($sql);
                $result->execute();
                $conn = null;
                header("Location: http://max.com:666/Maxfirstone/fullStack/PDOCRUD/create.php?{$_GET['DBSelect']}&success=NiceJob");
            } catch (PDOException $e) {
                $conn = null;
                die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
            }
        }

    }
}

?>