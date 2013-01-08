<?php

include '/../../lib/myTimer.php';

$sum = 0;
$easy_num = array();
$p_count = 0;
$time_limit = 300;
set_time_limit($time_limit * 2 + 1);

/*
 * Функция проверяет простое ли число и записывает массив простых чисел)
 */

function getArrayNum($num) {
    global $easy_num;
    if ($num == 1 || $num == 2 || $num == 3) {
        $easy_num[] = $num;
        return TRUE;
    } else {
        for ($i = 1; $i < count($easy_num); $i++) {
            $res = $num / $easy_num[$i];
            if ($res == ((int) ($res))) {
                $bool_res = FALSE;
                break;
            } else {
                $bool_res = TRUE;
            }
        }
    }
    if ($bool_res) {
        $easy_num[] = $num;
        return TRUE;
    }
}

/*
 * Функция проверяет простое ли число
 */

function getNum($num) {
    global $p_count;
    if ($num == 1 || $num == 2 || $num == 3) {
        $p_count++;
        return TRUE;
    }
    $i = 2;
    while ($num > $i) {
        $res = $num / $i;
        $int = (int) ($res);
        if ($res == $int) {
            $bool_res = FALSE;
            break;
        } else {
            $bool_res = TRUE;
        }
        $i++;
    }
    if ($bool_res) {
        $p_count++;
        return TRUE;
    }
}

/*
 * 
 */

function getSum($func_name) {
    global $time_limit, $p_count, $easy_num;
    $res_values = array();
    $res_values['sum'] = 0;
    $res_values['func_name'] = $func_name;
    $num = 1;
    $timer = new myTimer;
    $timer->start();
    while ($num <= $_POST['num']) {
        $time = $timer->val();
        if ($time > ($time_limit)) {
            $res_values['err_mess'] = 'Слишком большое число, я не успел его посчитать :(<br />';
            $res_values['num'] = $num;
            echo $res_values['err_mess'];
            break;
        }
        eval('$do = ' . $func_name);
        if ($do) {
            $res_values['sum'] += $num;
        }
        $num++;
    }
    $res_values['time'] = $timer->val('str');
    if (isset($easy_num) && count($easy_num) > 0) {
        $res_values['count'] = count($easy_num);
    }
    if (isset($p_count) && $p_count > 0) {
        $res_values['count'] = $p_count;
    }
    return $res_values;
}

function outMess($result) {
    echo '<br /><b>Пересчет функцией ' . $result['func_name'] . ' </b><br />';
    if (isset($result['err_mess'])) {
        echo $result['err_mess'];
        echo 'Я посчитал число ' . $result['num'] . '<br />';
    }
    echo 'Количество простых чисел: ' . $result['count'] . '<br />';
    echo 'Сумма простых чисел: ' . $result['sum'] . '<br />';
    echo 'Затрачено времени: ' . $result['time'] . '<br />';
}

?>
