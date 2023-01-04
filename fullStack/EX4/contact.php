<?
if ($_POST) {

    foreach ($_POST as $key => $value) {
        if ($value == null) {
            exit("$key" . "不能是空白。<br>");
            $error = true;
        }
    }
    if ($error) {
        exit;
    }
} else {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Max and his little friend">
  <meta name="description" content="little exam for html">
  <meta name="color-scheme" content="dark">
  <meta name="" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>聯絡表單</title>
</head>

<body>
  <form action="contact.php" method="post" Target="_blank">
    <fieldset>
      <legend>聯絡表單</legend>
      <label for="name">Name</label>
      <input type="text" id="name" name="name"><br><br>
      <label for="phone">Telephone</label>
      <input type="Tel" id="phone" name="phone"><br><br>
      <label for="suggest">Suggest</label>
      <textarea name="suggest" id="suggest" cols="30" rows="10"></textarea>><br><br>
      <input type="submit" value="確定">
      <input type="reset" value="取消">


    </fieldset>
  </form>
</body>

</html>

<!-- <?php

    if (array_sum($_POST) == 0) {
        exit;
    }

    foreach ($_POST as $key => $value) {
        if ($value == null) {
            exit("$key" . "不能是空白。<br>");
        }
    }

// if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['phone']) || empty($_POST['phone'])
//     || !isset($_POST['suggest']) || empty($_POST['suggest'])) {
//     exit;
// }

    echo "姓名 : " . $_POST['name'] . "<br>";
    echo "電話 : " . $_POST['phone'] . "<br>";
    echo "意見 : " . $_POST['suggest'] . "<br>";

    ?> -->
<?
}
?>