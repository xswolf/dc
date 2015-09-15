<?php
namespace Admin\Controller;
use Admin\Model\UserModel;
use Common\Controller\BaseController;

class UserController extends BaseController {

    public function index(){

    }

    public function login($name='',$password='',$verify='',$ajax=false){
        if (IS_POST) {
            if (C('VERIFY') && $verify != session(C('VERIFY_CODE'))) {
                // 验证码不对
                if($ajax) $this->ajaxReturn(['status'=>-1 , 'msg'=>'验证码错误']);
                $this->error('验证码错误');
            }
            $userInfo = UserModel::instance()->findByName($name);

            if (!$userInfo) {
                $this->ajaxReturn(['status'=>-1 , 'msg'=>'账号不存在']);
            }

            if ($userInfo && $userInfo['password'] == processPwd($password)) {
                // 登陆成功
                session(C('LOGIN_SESSION'), $userInfo);
                if($ajax) $this->ajaxReturn(['status'=>1 , 'msg'=>'登陆成功']);
                $this->success('登陆成功');
            } else {
                // 登陆失败
                if($ajax) $this->ajaxReturn(['status'=>-2 , 'msg'=>'账号或密码错误']);
                $this->error('登录失败');
            }
        }
        $this->display();
    }

    public function loginOut(){

        if (session(C('LOGIN_SESSION'))){
            session(C('LOGIN_SESSION') , '');
            $this->success();
        } else{
            $this->error('用户没有登录');
        }
    }

    public function register(){

    }
}