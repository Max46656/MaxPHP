<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <script src="../js/jquery-3.6.2.js"></script> -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.js'></script>
</head>

<body>
  <div style="text-align:center">
    <span>使用者</span><span><input type="text" name="username" id="username"></span><br>
    <span>密碼</span><span><input type="password" name="password" id="password"></span><br>
    <button type="button" id="loginSubmit">確認</button>

    <script>
    // console.log($("button"));
    // 因為該集合所擁有的元素數量在事件開始前是未決的，因此不能直接指定鍵值。
    // var username = document.getElementsByName('username')[0].value;<-錯誤
    var password = document.getElementsByName('password');
    //$->jQuery語法，#抓id。
    $("#loginSubmit").click(function() {
      //在事件開始前定義變數為所有符合條件的集合並在事件開始後定義詳細的鍵值是可行的
      var username = document.getElementsByName('username')[0].value;
      console.log("click")
      console.log(username);
      console.log(password[0].value);

      $.ajax({
        //請求
        type: "post",
        url: "http://max.com:666/MaxFirstOne/跨源輸入伺服.php",
        data: {
          username: username,
          password: password[0].value
        },
        dataType: "json",
        success: function(data) {
          //msg=ok
          if (data.msg == "OK") {
            console.log("success")
            alert("logon OK")
          }
        }
      });
    });
    </script>

  </div>

</body>

</html>