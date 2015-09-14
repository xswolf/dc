<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/11
 * Time: 9:15
 */

/**
 * 日期加减
 * @param $currDate
 * @param $n
 * @param string $type
 * @return string
 */
function dateAdd($currDate, $n, $type = 'd')
{
    switch ($type) {
        case "y":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n year"));
            break;
        case "m":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n month"));
            break;
        case "w":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n week"));
            break;
        case "d":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n day"));
            break;
        case "h":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n hour"));
            break;
        case "n":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n minute"));
            break;
        case "s":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n second"));
            break;
    }

    return $val;
}
