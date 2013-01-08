<?php

class countNum {

    public $_time_limit;
    public $res_values = array();

    function __construct($time_limit) {
        $this->_time_limit = $time_limit;
    }

    /*
     * Функция проверяет простое ли число и записывает массив простых чисел
     */

    function getArray($num) {
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
        if ($num == 1 || $num == 2 || $num == 3) {
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
            return TRUE;
        }
    }

    /*
     * 
     */

    function getSum($func_name) {
        $res_values['sum'] = 0;
        $res_values['func_name'] = $func_name;
        $num = 1;
        $timer = new myTimer;
        $timer->start();
        while ($num <= $_POST['num']) {
            $time = $timer->val();
            if ($timer->val() > $this->_time_limit) {
                $res_values['err_mess'] = 'Слишком большое число, я не успел его посчитать :(<br />';
                $res_values['num'] = $num;
                break;
            }
            eval('$do = $this->' . $func_name . '($num);');
            if ($do) {
                $res_values['sum'] += $num;
            }
            $num++;
        }
        $res_values['time'] = $timer->val('str');

        #return $res_values;
    }

    /*
     * 
     */

    function outMess() {
        echo '<br /><b>Пересчет функцией ' . $result['func_name'] . ' </b><br />';
        if (isset($result['err_mess'])) {
            echo $result['err_mess'];
            echo 'Я посчитал число ' . $result['num'] . '<br />';
        }
        #echo 'Количество простых чисел: ' . $result['count'] . '<br />';
        echo 'Сумма простых чисел: ' . $result['sum'] . '<br />';
        echo 'Затрачено времени: ' . $result['time'] . '<br />';
    }

}

?>
