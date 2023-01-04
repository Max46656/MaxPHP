<?

function 位數判斷($n)
{
    if ($n < 10) {
        return 1;
    }
    return 1 + floor(位數判斷($n / 10));
}

function 結果陣列($n)
{
    if (位數判斷($n) == 0) {
        echo implode(' ', $result);
        return;
    }
    $result[] = floor($n / pow(10, 位數判斷($n) - 1));
    return 結果陣列($n % pow(10, 位數判斷($n) - 1));

}

結果陣列(123456);
// function 印出數字分割($n)
// {
//     echo implode(' ', 結果陣列($n));
// }

// 印出數字分割(12);

// function decomp($n)
// {
//     echo intval($n / pow(10, $i - 1)) % 10 . ' ';
// }

//  for ($i = strlen(floor($n)); $i > 0; $i--)