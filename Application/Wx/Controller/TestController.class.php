<?php
namespace Wx\Controller;

use Wx\Controller\InitiativeController;
use Wx\Controller\ISendMessageController;
use Wx\WxPay\JsApiPay;

class TestController extends InitiativeController{
    
    public function index(){
//         ISendMessageController::instance(['tousername'=>"aaa"])->scanTableQrcode();
        $result = PayController::instance()->JsApiPay(2 , 1 , '高圆圆' , '嘎嘎嘎' ,'ggg') ;
        if($result['status']==1){
            $this->assign('json', $result['message']);
            $this->display();
        }
    }
}


