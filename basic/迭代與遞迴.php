<?

function F($n)
{
    if ($n == 1) {
        return 1;
    }
    return $n * F($n - 1);
}

function G($n)
{
    $sum = 1;
    for ($i = 1; $i <= $n; $i++) {
        $sum = $sum * $i;
    }
    return $sum;
}

$x = 5;
echo F($x);
echo "\n";
echo G($x);