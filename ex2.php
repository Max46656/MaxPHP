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


    foreach ($A[$k0] as $k1 => $v) {
        foreach ($A[$k0][$k1] as $k2 => $v) {
            foreach ($A[$k0][$k1][$k2] as $k3 => $v) {
                if ($k3 % 2 == 0) {
                    return TURE;
                } else {
                    return FLASE;
                }
                ;
            }
        }
    }
}

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
                }
                $Sum += $v;
            }
            echo "=" . $Sum . "<br>";
            $SumT0 += $Sum;
            $Sum = 0;
        }
        echo $SumT0 . "<br>";
        $SumT1 += $SumT0;
        $SumT0 = 0;

        if ($k2 == 2) {
            echo $SumT1 . "<br>";
        }
    }
    echo $SumT1 . "<br>";
    $SumT2 += $SumT1;
    $SumT1 = 0;
}
echo "<br>" . $SumT2 . "<br>";