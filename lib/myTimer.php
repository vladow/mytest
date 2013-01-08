<?php

class myTimer {

    private $_start;
    private $_val;

    private function getmicrotime() {
        list($usec, $sec) = explode(" ", microtime());
        $microtime = ((float) $usec + (float) $sec);
        return $microtime;
    }

    public function start() {
        $this->_start = $this->getmicrotime();
    }

    private function goStr($str, $ln) {
        while (strlen($str) < $ln) {
            $str = '0' . $str;
        }
        return $str;
    }

    private function getVal() {
        $end = $this->getmicrotime();
        $this->_val = $end - $this->_start;
    }

    public function val($val = NULL) {
        $this->getVal();
        if ($val == 'str') {
            $sec = (int) ($this->_val);
            $msec = (int) (($this->_val - $sec) * 1000);
            $first = $this->_val * 1000;
            $second = $first - (int) ($first);
            $res = (int) ($second * 1000);
            $mksec = $res;
            $str = "{$this->goStr($sec, 2)} сек : {$this->goStr($msec, 3)} мсек : {$this->goStr($mksec, 3)} мксек";
            return $str;
        }  else {
            return $this->_val;    
        }
    }

}

?>