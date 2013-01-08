<?php

$a = 0;
$b = 1000000;
include '/../../lib/myTimer.php';

$timer = new myTimer;
$timer->start();
for ($index = 0; $index < $b; $index++) {
    $a += $index;
}
echo "Я постчитал сумму чисел от 0 до $b за {$timer->val()} Результат => $a";
?>