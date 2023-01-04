<?php

require_once "connDB.php";

$del = $_POST['del'];
$sql_delete = "delete from members where m_id in(%s)";
$sql_where = "";
foreach ($del as $value) {
    $sql_where = $sql_where . ",'$value'";
}

$sql_where = substr($sql_where, 1, mb_strlen($sql_where) - 1);
// echo $sql_where . "<br>";
$sql_delete = sprintf($sql_delete, $sql_where);
echo $sql_delete . "<br>";
mysqli_query($conn, $sql_delete);
mysqli_close($conn);
header('location:index.php');