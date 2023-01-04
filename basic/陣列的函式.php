<?php
$A = [[[[1, 2, 3, 4, 5, 6, 7],
    [10, 11, 12, 13, 14, 15, 16]],
    [[20, 21, 22, 23, 24, 25, 26],
        [30, 31, 32, 33, 34, 35, 36]]],
    [[[40, 41, 42, 43, 44, 45, 46],
        [50, 51, 52, 53, 54, 55, 56]],
        [[60, 61, 62, 63, 64, 65, 66],
            [70, 71, 72, 73, 74, 75, 76]]]];
// $A[0][0][0] = [100, 200, 300, 400, 500, 600, 700];
// sort()  遞增
// rsort() 遞減
//ksort()   用鍵值做遞增排序
//asort()   用值做遞增排序
//krsort()   用鍵值做遞減排序
//arsort()   用值做遞減排序
ksort($A);
foreach ($A as $k0 => $v) {
    asort($A[$k0]);
    foreach ($A[$k0] as $k1 => $v) {
        krsort($A[$k0][$k1]);
        foreach ($A[$k0][$k1] as $k2 => $v) {
            arsort($A[$k0][$k1][$k2]);
        }
    }
}
var_export($A);
echo "<br>" . "<br>";

$B = ["X" => ["A" => 0, "B" => 1, "C" => 2, "D" => 3],
    "Y" => ["E" => 4, "F" => 5, "G" => 6, "H" => 7]];
var_dump($B);
echo "<br>";

print $B["X"]["A"];

// isset()跟unset()
if (!isset($B["X"]["B"])) {
    $B["X"]["B"] = 10;
}
print $B["X"]["B"] . "<br>";

unset($B["X"]["B"]);
$B["X"]["B"] = 20;
print $B["X"]["B"] . "<br>" . "<br>";

//拜訪需用「鍵值」
foreach ($B as $key => $value) {
    foreach ($B[$key] as $key => $value) {
        echo "$key=>$value <br>";
    }
}
