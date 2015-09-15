<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 12:20
 */

/**
 * 密码处理
 * @param $pwd
 * @param string $str
 * @return string
 */
function processPwd($pwd , $str = ""){
    return md5($pwd.$str);
}