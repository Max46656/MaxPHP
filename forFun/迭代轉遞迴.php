<?

function 印出數字($n)
{
    $i = 位數判斷($n);
    if ($n < 10) {
        return $result[] = $n;
    }
    $result[] = floor($n / (10 ** ($i - 1)));
    return 印出數字($n % (10 ** ($i - 1)));
}

// for ($j = $i; $j > 0; $j--) {
//     $result[] = floor($n / 10 ** $j - 1);
//     $n = $n % 10 ** $j - 1;
// }

function 陣列製作($n)
{
    $i = 位數判斷($n);

    if ($n < 10) {
        return $result[] = $n;
    }
    return 陣列製作(intval($n / (10 ** ($i - 1))) % 10);

}

function 位數判斷($n)
{
    if ($n < 10) {
        return 1;
    }
    return 1 + floor(位數判斷($n / 10));
}

// var_export($result);

// echo implode(' ', 印出數字(123456));