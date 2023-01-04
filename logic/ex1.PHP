<?

$score = [101, 102, 104, 105, 106];

$CountScore = count($score);

$sum = 0;

foreach ($score as $k => $v) {

    echo $v;
    if ($k < $CountScore - 1) {
        echo "+";
    }
    $sum += $v;
}
echo "=" . $sum;

echo "<br>";

for ($i = 0; $i < $CountScore; $i++) {

    $sum = $sum + $score[$i];

}

for ($i = 0; $i < $CountScore - 1; $i++) {

    echo $score[$i] . "+";

}
echo $score[$CountScore - 1] . "=" . $sum;