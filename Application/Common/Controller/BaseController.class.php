<?php
namespace Common\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 9:17
 */

class BaseController extends \Think\Controller{


    /**
     * @return self
     */
    public static function instance($args = ""){

        $class = get_called_class();
        static $instance;
        if (isset($instance[ $class ])) {
            return $instance[ $class ];
        }

        $obj = new $class($args);
        $instance[ $class ] = $obj;

        return $instance[ $class ];
    }

    public function ajaxSuccess($data){
        parent::ajaxReturn(['status'=>1 , 'message'=>'成功' , 'data' => $data]);
    }

    public function ajaxError($data){
        parent::ajaxReturn(['status'=>-1 , 'message'=>'失败' , 'data' => $data]);
    }
}