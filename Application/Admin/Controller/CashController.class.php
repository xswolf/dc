<?php
namespace Admin\Controller;
use Admin\Model\CashModel;
use Common\Controller\VerifyController;

class CashController extends VerifyController {

    public function index(){

        $list = CashModel::instance()->lists($this->user->getShopId());
        $this->assign('list' , $list);
        $this->display();
    }

    public function cash(){
        if(CashModel::instance()->cash($this->user->getShopId())){
            $this->_success('申请成功' , U('Cash/cashList'));
        }
    }

    public function cashList(){

        $list = CashModel::instance()->cashList($this->user->getShopId());
        $this->assign('list' , $list);
        $this->display();
    }
}