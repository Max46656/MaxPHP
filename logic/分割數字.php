<?
function 位數判斷($insert)
{
    $i = 1;
    while ($insert >= 10 ** $i) {
        $i++;
    }
    return $i;
}

function 印出數字($insert)
{
    $i = 位數判斷($insert);

    for ($j = $i; $j > 0; $j--) {
        $result[] = floor($insert / 10 ** $j);
        $insert = $insert % 10 ** $j;
    }
    return implode(' ', $result);
}

function decamp($insert)
{
    $j = 1;
    for ($i = 0; $i < $j; $i++) {
        if ($insert >= pow(10, $i)) {
            $j++;
        } else {
            $l = $i;
            $y = $insert;
            for ($k = 1; $k < $j; $k++) {
                if ($i >= 0) {
                    $result[] = floor($y / pow(10, $l - 1));
                    $y = $y % pow(10, $l - 1);
                    $l--;
                }
            }
            return implode(' ', $result);
        }
    }
}
$startTime = microtime(true);

for ($i = 1; $i < 1000; $i++) { //壓力測試迴圈數

    印出數字(12346);

}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒
echo "\n";

echo "巢狀簡化後 run time: {$runtime} ms";

echo "\n";

for ($i = 1; $i < 1000; $i++) { //壓力測試迴圈數

    decamp(123456);

}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒
echo "\n";

echo "巢狀簡化前 run time: {$runtime} ms";