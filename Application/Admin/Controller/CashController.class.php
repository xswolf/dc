<?php
namespace Admin\Controller;
use Admin\Model\CashModel;
use Common\Controller\VerifyController;

class CashController extends VerifyController {

    public function index(){

        $list = CashModel::instance()->lists($this->user->getShopId());

        $sumMoney = 0;
        foreach ($list as $v){
            $sumMoney += $v['cash_money'];
        }

        $this->assign('list' , $list);
        $this->assign('sumMoney' , $sumMoney);
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