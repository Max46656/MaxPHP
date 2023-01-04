<?
function randomPMT($minN, $maxN, $countN)
{
    if ($minN >= $maxN) {
        die("第二參數需要比第一參數大。");
    }
    if ($countN > $maxN - $minN) {
        die("兩數之間沒有這麼多整數。");
    }
    $originalArray = range($minN, $maxN);
    shuffle($originalArray);

    for ($i = 0; $i < $countN; $i++) {
        $randPMT[] = $originalArray[$i];
    }
    echo implode(" ", $randPMT);
}

//     if ($minN <= $maxN) {
//         if ($countN > $maxN - $minN) {
//             $originalArray = range($minN, $maxN);
//             shuffle($originalArray);
//             for ($i = 0; $i < $countN; $i++) {
//                 $randPMT[] = $originalArray[$i];
//             }
//         } else {
//             die("兩數之間沒有這麼多整數。");
//         }
//     } else {
//         die("第二參數需要比第一參數大。");
//     }