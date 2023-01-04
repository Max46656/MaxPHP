<?php

namespace Myfirstone;

$A = __LINE__;
$B = __FILE__;
$C = __DIR__;
$D = __NAMESPACE__;

class A
{
    public function fun()
    {
        $E = __FUNCTION__;
        echo "此函數名稱{$E}" . "<br>";
    }
    public function meth()
    {
        $F = __CLASS__;
        $G = __METHOD__;
        echo "此類別名稱 {$F} <br>";
        echo "此方法名稱 {$G} <br>";
    }
}

echo "此程式運行行數 {$A} <br>";
echo "此程式位置與檔名{$B} <br>";
echo "此程式位置{$C}" . "<br>";
echo "此命名空間名稱{$D}" . "<br>";