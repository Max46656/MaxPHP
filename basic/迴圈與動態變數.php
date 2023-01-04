<?
$A = ["X", "Y", "Z"];
$B = [4, 5, 6];
$C = count($B);

for ($i = 0; $i < $C; $i++) {

    ${'D' . $A[$i]} = $B[$i];
    echo "D" . $A[$i] . "=" . $B[$i];
    echo "<br>";

}

$E = ["DX" => 4, "DY" => 5, "DZ" => 6];

foreach ($E as $k => $v) {

    echo $k . "=" . $v;
    echo "<br>";

}

$A = "B";
$B = "C";
$C = "A";

print $A;
print $$A;
print $$$A;
print $$$$A;
print $$$$$A;