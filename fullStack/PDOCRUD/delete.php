<?php
require_once "connDB.php";
$connDB = new connDB;
$delete = new delete($connDB);
if (!isset($_POST["action"]) or !$_POST["action"] == "delete") {
    try {
        header("Location:index.php?DBSelect={$DBSelect}&error=delete");
        exit;
    } catch (\Throwable$th) {
        die("_:(´-ω-｀)」∠)");
    }
}
if (count($_GET) == 2 and count($_POST) == 0) {
    echo $delete->deleteOne();
}
if (count($_GET) == 3 and count($_POST) == 0) {
    echo $delete->deleteOneJunction();
}
if (count($_GET) == 1 and count($_POST) == 1) {
    echo $delete->deleteMultiple();
}
if (count($_GET) == 1 and count($_POST) == 2) {
    echo $delete->deleteMultiple();
}
die("( ˘•ω•˘ )你是不是在做什麼奇怪的事");

class delete
{
    protected static $connDB;

    public function __construct(connDB $connDB)
    {
        self::$connDB = $connDB->ConnDB();
        $connDB = null;
    }
    public function deleteOne()
    {
        try {
            $conn = self::$connDB;
            $sql = "DELETE FROM `{$_GET['DBSelect']}` WHERE `id`={$_GET['id']}";
            $result = $conn->prepare($sql);
            $result->execute();
            $result = null;
            $conn = null;
            header("Location:index.php?DBSelect={$_GET['DBSelect']}&deleteOne=NiceJob");
        } catch (PDOException $e) {
            die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
            // die("( ˘•ω•˘ )沒有這項資料…<br>_:(´-ω-｀)」∠):_或是資料庫爆炸了…");
        }
    }
    public function deleteMultiple()
    {
        try {
            $conn = self::$connDB;
            $del = $_POST['del'];
            $sql = "DELETE FROM `{$_GET['DBSelect']}` WHERE `id` IN (";
            foreach ($del as $key => $value) {
                $sql .= "'$value',";
            }
            $sql = chop($sql, ",'");
            $sql .= ");";
            $result = $conn->prepare($sql);
            $result->execute();
            $result = null;
            $conn = null;
            header("Location:index.php?DBSelect={$_GET['DBSelect']}&deleteMultiple=NiceJob");
        } catch (PDOException $e) {
            die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
            // die("( ˘•ω•˘ )沒有這項資料…<br>_:(´-ω-｀)」∠):_或是資料庫爆炸了…");
        }
    }
    public function deleteOneJunction()
    {
        try {
            $conn = self::$connDB;
            $sql = "SET FOREIGN_KEY_CHECKS=0;";
            $sql .= "DELETE FROM `{$_GET['DBSelect']}` WHERE";
            $DBSelect = array_shift($_GET);
            $id1n = key($_GET);
            $id1v = array_shift($_GET);
            $id2n = key($_GET);
            $id2v = array_shift($_GET);
            $sql .= "`$id1n`='$id1v' AND `$id2n`='$id2v';";
            $sql .= "SET FOREIGN_KEY_CHECKS=1;";
            $result = $conn->prepare($sql);
            $result->execute();
            $result = null;
            $conn = null;
            header("Location:index.php?DBSelect={$DBSelect}&deleteOne=NiceJob");
        } catch (PDOException $e) {
            die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
            // die("( ˘•ω•˘ )沒有這項資料…<br>_:(´-ω-｀)」∠):_或是資料庫爆炸了…");
        }
    }
    public function deleteMultipleJunction()
    {
        try {
            $conn = self::$connDB;
            $del = $_POST['del'];
            $sql = "DELETE FROM `{$_GET['DBSelect']}` WHERE `id` IN (";
            foreach ($del as $key => $value) {
                $sql .= "'$value',";
            }
            $sql = chop($sql, ",'");
            $sql .= ");";
            $result = $conn->prepare($sql);
            $result->execute();
            $result = null;
            $conn = null;
            header("Location:index.php?DBSelect={$_GET['DBSelect']}&deleteMultiple=NiceJob");
        } catch (PDOException $e) {
            die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
            // die("( ˘•ω•˘ )沒有這項資料…<br>_:(´-ω-｀)」∠):_或是資料庫爆炸了…");
        }
    }
}