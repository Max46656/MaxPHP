<?php

echo "Hello Winnie <br/>";

echo "Hello";
echo " ";
echo "Winnie";
echo "<br />";

$name = 'Winnie';
$hi = 'Hello';
echo $hi . ' ' . $name;

echo "<br />";

$lol = <<<EOT
 $hi . ' ' . $name '<br>'
 Hello <br>  Winnie
EOT;

echo $lol;