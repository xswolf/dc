<?php
namespace Common\Controller;
use Common\Model\UserModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 9:17
 */

class VerifyController extends BaseController{

    /**
     * @var UserModel
     */
    protected $user = null;

    public function _initialize(){

        if (!UserModel::instance()->isLogin()){  // 判断用户是否登录

            $this->redirect("user/login");
        }else{

            $this->user = UserModel::instance();
            $this->user->setUser(session(C("LOGIN_SESSION")));
        }
    }


    public static function instance($args){

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