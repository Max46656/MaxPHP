<?php
$A = [[[[1, 2, 3, 4, 5, 6, 7],
    [10, 11, 12, 13, 14, 15, 16]],
    [[20, 21, 22, 23, 24, 25, 26],
        [30, 31, 32, 33, 34, 35, 36]]],
    [[[40, 41, 42, 43, 44, 45, 46],
        [50, 51, 52, 53, 54, 55, 56]],
        [[60, 61, 62, 63, 64, 65, 66],
            [70, 71, 72, 73, 74, 75, 76]]]];

$Sum = 0;
$SumT0 = 0;
$SumT1 = 0;
$SumT2 = 0;

foreach ($A as $k0 => $v) {
    foreach ($A[$k0] as $k1 => $v) {
        foreach ($A[$k0][$k1] as $k2 => $v) {
            foreach ($A[$k0][$k1][$k2] as $k3 => $v) {
                $X3 = 0;
                $X3 = 0;
                if ($k3 % 2 == 0) {
                    $X3 += 1;
                } else {
                    $X3 = 0;
                }
            }
            if ($X3 == $k2) {
                $X2 += 1;
    }
            if ($X3 == $k2) {
                $X2 += 1;
            } else {
                $X2 = 0    } else {
                $X2 = 0;
            }
        }
        if ($X2 == $k1) {
            $X1 += 1;
        } else {
            $X1 = 0;
        }
    }
    if ($X1 == $k0) {
        $X0 = true;
    } else {
        $X0 = false;
    }
}
// 判斷陣列中每一行項目均為偶數。
if ($X0 = true) {
    foreach ($A as $k0 => $v) {
        foreach ($A[$k0] as $k1 => $v) {
            foreach ($A[$k0][$k1] as $k2 => $v) {
                foreach ($A[$k0][$k1][$k2] as $k3 => $v) {
                    if ($k3 % 2 == 0) {
                        echo $v;
                    } else {
                        echo "+";
                        echo $v;
                        echo "+";
                        // 當為偶數時以奇偶判斷迴圈，並在奇數前後放置+號
                    }
                    $Sum += $v;
                }
                echo "=" . $Sum . "<br>";
                $SumT0 += $Sum;
                $Sum = 0;
                // 列印每一行的計算結果並將該結果加入上一維陣列的小計。
            }
            echo $SumT0 . "<br>";
            $SumT1 += $SumT0;
            $SumT0 = 0;
            // 列印小計並將該結果加入上一維陣列的小計。
            if ($k1 == 2) {
                echo $SumT1 . "<br>";
            }
        }
        echo $SumT1 . "<br>";
        $SumT2 += $SumT1;
        $SumT1 = 0;
    }
}
echo "<br>" . $SumT2 . "<br>";