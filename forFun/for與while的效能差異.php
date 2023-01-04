<?
function HowWhile($insert)
{
    $i = 1;
    while ($insert >= $i) {
        $i++;
    }

}
function HowFor($insert)
{
    for ($i = 1; $i <= $insert; $i++) {

    }

}

$startTime = microtime(true);

HowWhile(100000);

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "run time: {$runtime} ms";

echo "\n";

HowFor(100000);

$endTime = microtime(true);
$runtime = ($endTime - $startTime) * 1000; //將時間轉換為毫秒

echo "run time: {$runtime} ms";