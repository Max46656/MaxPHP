<?
header("contect-type:text/html; charset=utf-8", true);
date_default_timezone_set("Asia/Taipei");

$user = "Max";
$password = "SAYWHAT";
$host = "localhost";
$db = "ch08";
$port = "3306";

//建立連結
$conn = new mysqli($host, $user, $password, $db, $port);

function test($conn, $method = true)
{
    if ($conn) {
        //判斷是否連接
        //設置編碼
        mysqli_query($conn, 'set names utf8');
        mysqli_set_charset($conn, "utf8");
        //創建sql子句
        $sql = "SELECT * FROM `employee`";

        $result = mysqli_query($conn, $sql);
        // print_r($result);

        if (mysqli_num_rows($result)) {
            $info = [];

            if ($method) { //method true
                while ($row = $result->fetch_assoc()) {
                    $info[] = $row;
                }
            } else { //method false
                foreach ($result as $value) {
                    $info[] = $value;
                }
            }
        }
        return $info;
    }
}
echo '<pre>' . var_dump(json_encode(test($conn, false), JSON_UNESCAPED_UNICODE)) . '</pre>';
echo '<pre>' . var_dump(json_encode(test($conn, true), JSON_UNESCAPED_UNICODE)) . '</pre>';

$startTime = microtime(true);

$result = [];
for ($i = 1; $i <= 1000; $i++) { //壓力測試迴圈數
    $result[] = test($conn, true);
}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "<h2 style='color:red'> run time: {$runtime} ms </h2>";
//
echo "\n";
//
$startTime = microtime(true);

$result = [];
for ($i = 1; $i <= 1000; $i++) { //壓力測試迴圈數
    $result[] = test($conn, false);
}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "<h2 style='color:red'> run time: {$runtime} ms </h2>";