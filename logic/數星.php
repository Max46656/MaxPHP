<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div>
    <form action="數星.php" method="get">
      請輸入列數<input type="number" name="Star" id="">
    </form>
  </div>
</body>

</html>

<?php
if (is_numeric($_GET['Star'])) {
    $Row = $_GET['Star'];

    echo "Row=$Row<br>";

    for ($i = 0; $i < $Row; $i++) {
        $RowS[$i] = (int) $Row - $i;
        // $RowS[$i] = (int) [$Row - $i]<<布林判斷式
    }

    for ($i = 0; $i < count($RowS); $i++) {
        for ($a = $RowS[$i]; $a > 0; $a--) {
            echo "*";
        }
        echo "<br>";
    }
}
