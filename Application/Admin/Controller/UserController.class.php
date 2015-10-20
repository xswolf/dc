<?php
namespace Admin\Controller;
use Common\Model\UserModel;
use Common\Controller\BaseController;

class UserController extends BaseController {

    public function index(){

    }

    public function login($username='',$password='',$verify='',$ajax=true){
        layout(false);

        if (IS_POST) {

            if (C('VERIFY') && $verify != session(C('VERIFY_CODE'))) {
                // 验证码不对
                if($ajax) $this->ajaxReturn(['status'=>-1 , 'msg'=>'验证码错误']);
                $this->error('验证码错误');
            }
            $userInfo = UserModel::instance()->findByName($username);

            if (!$userInfo) {
                $this->assign("error" , "用户不存在");
            }else{
                if ($userInfo && $userInfo['password'] == processPwd($password)) {
                    // 登陆成功
                    session(C('LOGIN_SESSION'), $userInfo);
                    $this->redirect('index/index');
                } else {
                    $this->assign("error" , "密码错误");
                }
            }
            $this->assign("username" , $username);
            $this->assign("password" , $password);
        }
        $this->display();
    }

    public function loginOut(){

        if (session(C('LOGIN_SESSION'))){
            session(C('LOGIN_SESSION') , null);
            $this->redirect('user/login');
        } else{
            $this->error('用户没有登录');
        }
    }

    public function register(){
        layout(false);
        $this->display();
    }
}