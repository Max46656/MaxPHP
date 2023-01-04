<!DOCTYPE html>
<html lang="zh_TW">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="CRUD in PDO">
  <meta name="color-scheme" content="light">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="javascript.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>資料管理CRUD</title>
</head>

<body>

  <?$Read = new Read;?>
  <h1 align='center'>
    <?echo $Read->title(); ?>管理
  </h1>
  <br><br><br>
  <div id="main">

    <form id="DBform" action="http://max.com:666/Maxfirstone/fullStack/CRUD/PDOindex.php" method="GET" align="center">
      資料表選擇：<select name="DBSelect">
        <?echo $Read->DBSelect(); ?>
      </select><br>
      <input type="submit" value="送出" id="submit">
    </form>

    <?echo $Read->DBcount(); ?>
    <p align="center">
      <?echo $Read->CreateLink() ?>
      &emsp;
      <?echo $Read->DeleteLink() ?>
    </p>

    <form id="formR" action="http://max.com:666/Maxfirstone/fullStack/CRUD/PDOindex.php" method="POST" align="center">
      <table class="DBTable" align="center">
        <thead align="center">
          <?echo $Read->fromTitle(); ?>
        </thead>
        <tbody>
          <tr align="center">
            <?echo $Read->fromContent(); ?>
          </tr>
        </tbody>
      </table>
      <p align="center">
        <?echo $Read->pageUrl(); ?>
      </p>
  </div>

</body>

</html>

<?php
class Read
{
    public function __construct()
    {
        require_once "PDOconnDB.php";
        require_once 'SingularPlural.php';
    }
    public function title()
    {
        if (!isset($_GET['DBSelect'])) {
            return "專案資料";
        }
        $title = mb_convert_case($_GET['DBSelect'], MB_CASE_TITLE, "UTF-8");
        return $title;
    }
    public function DBcount()
    {
        if (!isset($_GET['DBSelect'])) {
            return null;
        }
        $pageData = $this->page();
        $count = $pageData["count"];
        $total_page = $pageData["total_page"];
        $page = $pageData["page"];
        $htmlTag = "<p align='center' >目前有{$count}筆資料。<br>目前在第{$page}頁，總共有{$total_page}頁。</p>";
        return $htmlTag;
    }
    public function CreateLink()
    {
        if (!isset($_GET['DBSelect'])) {
            return null;
        }
        $title = $this->titleSingular();
        $htmlTag = "<button><a href='PDOcreate.php?DBSelect={$_GET['DBSelect']}' >";
        $htmlTag .= "新增一筆" . $title;
        $htmlTag .= "</a></button>";
        return $htmlTag;
    }
    public function DeleteLink()
    {
        if (!isset($_GET['DBSelect'])) {
            return null;
        }
        $htmlTag = "<button><a href=\"#\" onclick='delAll();'>刪除勾選資料</a></button>&emsp;";
        return $htmlTag;
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
    public function titleSingular()
    {
        $title = $this->title();
        $titleSingular = Inflect::singularize($title);
        return $titleSingular;
    }
    public function fromTitle()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conn = new connDB;
        $result = $conn->fieldMeta();
        $htmlTag = "";
        foreach ($result as $key => $value) {
            $htmlTag .= "<th>$key</th>";
        }
        $htmlTag .= "<td>哈哈打錯字</td>";
        $htmlTag .= "<td>刪除單項資料</td>";
        $htmlTag .= "<td>勾選資料</td>";
        $result = null;
        $conn = null;
        return $htmlTag;
    }
    public function fromContent()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $pageData = $this->page();
        $start = $pageData["start"];
        $per_page = $pageData["per_page"];
        $conn = new connDB;
        $sql = "SELECT * FROM `" . $_GET['DBSelect'] . "`limit " . $start . "," . $per_page;
        $conn = $conn->ConnDB();
        $result = $conn->prepare($sql);
        $result->execute();
        $htmlTag = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $htmlTag .= "<tr>";
            foreach ($row as $key => $value) {
                if ($key == "enabled") {
                    if ($value == 1) {
                        $value = "true";
                    } else {
                        $value = "false";
                    }
                }
                $htmlTag .= "<td>" . $value . "</td>";
            }
            $htmlTag .= "<td class=face><a href='PDOupdate.php?id={$row["id"]}'><button>(ﾟ∀。)</button></a></td>";
            $htmlTag .= "<td class=face><a href='PDOdelete.php?m_id={$row["id"]}'><button>( ×ω× )</button></a></td>";
            $htmlTag .= "<td><input type='checkbox' name='del[]' value='{$row['id']}'></td>";
            $htmlTag .= "</tr>";
        }
        $result = null;
        $conn = null;
        // return $start;
        return $htmlTag;
    }
    public function page()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conn = new connDB;
        $conn = $conn->ConnDB();
        $sql = "SELECT * FROM `" . $_GET['DBSelect'] . "`";
        $result = $conn->prepare($sql);
        $result->execute();
        $count = $result->rowCount();
        $nowPage = 1;
        if (isset($_GET['Page'])) {
            $nowPage = $_GET['Page'];
        }
        $per_page = 12;
        $total_page = ceil($count / $per_page);
        $prev = $nowPage - 1;
        $next = $nowPage + 1;
        $start = ($nowPage - 1) * $per_page;
        $pageData = ["per_page" => $per_page, "start" => $start, "total_page" => $total_page, "count" => $count, "page" => $nowPage, "prev" => $prev, "next" => $next];
        $result = null;
        $conn = null;
        return $pageData;
    }
    public function pageUrl()
    {
        $pageData = $this->page();
        $total_page = $pageData["total_page"];
        $prev = $pageData["prev"];
        $next = $pageData["next"];
        $page = $pageData["page"];
        $htmlTag = "";

        switch ($page) {
            case 1:
                $htmlTag = "<button><a href='?DBSelect={$_GET['DBSelect']}&Page=$next'>下一頁</a></button>
                <button><a href='?DBSelect={$_GET['DBSelect']}&Page=$total_page'>尾頁</a></button>";
                break;
            case $total_page;
                $htmlTag = "<button><a href='?DBSelect={$_GET['DBSelect']}&Page=1'>首頁</a></button>
                <button><a href='?DBSelect={$_GET['DBSelect']}&Page=$prev'>上一頁</a></button>";
                break;
            default:
                $htmlTag = "<button><a href='?DBSelect={$_GET['DBSelect']}&Page=1'>首頁</a></button>
                <button><a href='?DBSelect={$_GET['DBSelect']}&Page=$prev'>上一頁</a></button>
                <button><a href='?DBSelect={$_GET['DBSelect']}&Page=$next'>下一頁</a></button>
                <button><a href='?DBSelect={$_GET['DBSelect']}&Page=$total_page'>尾頁</a></button>";
                break;
        }
        return $htmlTag;
    }
}