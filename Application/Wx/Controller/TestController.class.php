<?php
namespace Wx\Controller;

use Wx\Event\PayEvent;
use Common\Controller\BaseController;

class TestController extends BaseController{
    
    public function index(){
//         ISendMessageController::instance(['tousername'=>"aaa"])->scanTableQrcode();
        $result = PayEvent::instance()->JsApiPay(2 , 1 , '高圆圆' , '嘎嘎嘎' ,'ggg') ;
        if($result['status']==1){
            dump($result['message']);
            $this->assign('json', $result['message']);
            $this->display();
        }
    }
}


