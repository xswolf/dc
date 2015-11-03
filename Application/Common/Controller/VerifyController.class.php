<?php
namespace Common\Controller;
use Common\Model\UserModel;
use Admin\Model\PlatformShopModel;

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

            if ($this->user->getId() == 1){  // 管理员
                layout(false);
                $list = PlatformShopModel::instance()->getList();
                $this->assign("list" , $list);

            }else{  // 店铺用户
                if ($this->user->getShopStatus() == 0){
                    $this->redirect("user/login" , ['error'=>1]);
                }
            }
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

    /**
     * 成功提示
     * @param string $msg
     * @param string $url
     * @param string $title
     */
    protected function _success($msg = '操作成功', $url = '', $title = '恭喜!') {
        if ($url) {
            $this->_alert('success', $msg, $title);
            redirect($url);
        } else {
            $this->_alert('success', $msg, $title);
        }
    }

    /**
     * 错误提示
     * @param string $msg
     * @param string $url
     * @param string $title
     */
    protected function _error($msg = '操作失败', $url = '', $title = '糟糕!') {
        if ($url) {
            $this->_alert('error', $msg, $title);
            redirect($url);
        } else {
            $this->_alert('error', $msg, $title);
        }
    }

    /**
     * 赋值消息提示
     * @param $type
     * @param $msg
     */
    protected function _alert($type, $msg) {

        cookie($type,$msg);  //设置cookie
    }
}