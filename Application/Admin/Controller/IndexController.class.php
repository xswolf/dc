<?php
namespace Admin\Controller;
use Admin\Model\CashModel;
use Admin\Model\PlatformShopModel;
use Common\Controller\VerifyController;
use Common\Model\UserModel;

class IndexController extends VerifyController {

    public function _initialize(){
        parent::_initialize();
        if ($this->user->getId() != 1)
            $this->redirect('order/index');
    }

    public function index(){

        $list = PlatformShopModel::instance()->getList();
        $this->assign('list' , $list);
        $this->display();
    }

    public function add(){
        layout(false);
        if ($_POST) {
            if (!UserModel::instance()->findByProperties("name" , I('name'))){
                if (PlatformShopModel::instance()->addShop($_POST)) {
                    $this->_success("添加成功" , "/admin/index/index");
                } else {
                    $this->assign('data' , $_POST);
                    $this->_error("添加失败");
                }
            }else{
                $this->assign('data' , $_POST);
                $this->_error("添加失败 用户已经存在");
            }


        }
        $this->display();
    }


    public function edit($id){
        $user = UserModel::instance()->findByProperties("id" , $id);
        $shop = UserModel::instance()->findByProperties("uid" , $id , "platform_shop");
        $shop[0]['shopName'] = $shop[0]['name'];
        unset($shop[0]['name']);
        unset($shop[0]['id']);
        $data = array_merge($user[0],$shop[0]);

        if($_POST){
            PlatformShopModel::instance()->editShop($id , $_POST);
            $this->_success("编辑成功" , "/admin/index/index/" );
        }
        $this->assign('data' , $data);
        $this->display();
    }

    public function setShopStatus(){
        $status = I('status');
        PlatformShopModel::instance()->where(['uid'=>I('id')])->setField('status' , $status);
        $this->ajaxSuccess('设置成功');
    }

    // 申请提现列表
    public function cashList(){
        $list = CashModel::instance()->cashList();

        $this->assign('list' , $list);
        $this->display();
    }

    // 申请提现列表
    public function cashList1(){
        $list = CashModel::instance()->cashList('' , 1);

        $this->assign('list' , $list);
        $this->display();
    }
}