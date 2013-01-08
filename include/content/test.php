<?php
#error_reporting(0);
include '/../../lib/myTimer.php';
include '/../../lib/countNum.php';
$count_num = new countNum(30);
?>
Программа состоит из двух функций. Функции считают сумму простых чисел в промежутке от 1 до 
<?php
if (isset($_POST['num'])) {
    echo "заданного вами(<i>{$_POST['num']}</i>)";
} else {
    echo 'заданного вами';
}
?>, не дольше <?php echo "<i>$count_num->_time_limit</i>"; ?> секунд каждая. 
Функция <i>getArrayNum()</i> делит только на простые числа, но, также, записывает их в массив. 
Функция <i>getNum()</i> делит на все числа из перебора по интервалу.
<form method="post">
    <br /><label>Введите число: </label>
    <input type="number" name="num"/>
    <input type="submit" value="Ok" name="ok" />
</form>
<?php
if (isset($_POST['num'])) {
    echo 'Вы ввели: ' . $_POST['num'] . '<br />';
// пересчет функцией getNum($num);
    $count_num->getSum('getNum');
    $array_time = $count_num->res_values['time'];
    $count_num->outMess;
//// пересчет функцией getArrayNum($num);
//    $count_num->getSum('getArray');
//    $array_time = $count_num->res_values['time'];
//    $count_num->outMess;
// сравнение результатов работы двух функций
    if ($num_time > $array_time) {
        $time = $num_time - $array_time;
        $func = '<b>getArrayNum($num)</b>';
    } else {
        $time = $array_time - $num_time;
        $func = '<b>getNum($num)</b>';
    }
    echo "<br />Ура! Победила функция $func, посчитав быстрее на $time сек.";
}
?>