<?php
$startTime = microtime(true);

for ($i = 1; $i < 100000; $i++) { //壓力測試迴圈數

    pow($i, $i);

}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "pow($i, $i) run time: {$runtime} ms";
//
echo "\n";
//
$startTime = microtime(true);

for ($i = 1; $i < 100000; $i++) { //壓力測試迴圈數

    $i ** $i;
}

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "$i ** $i run time: {$runtime} ms";
