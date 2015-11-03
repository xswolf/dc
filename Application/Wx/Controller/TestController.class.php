<?php
namespace Wx\Controller;

use Wx\Event\PayEvent;
use Common\Controller\BaseController;
use LaneWeChat\Core\ResponseInitiative;

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
    
    public function test(){
        $material = M("wx_material")->where(['key'=>'table'])->find();
        $material['content']    =   unserialize($material['content']);
        $shop_id = 123;
         foreach($material['content'] as &$val){
                        $val['title']    =   str_replace('__桌号__', "ABC桌", $val['title']);
                        $val['url']    =   str_replace("__shop_id__" , "21" , $val['url']);
                        $val['url']    =   str_replace("__mid__" , "12" , $val['url']);
                        $val['url']    =   str_replace("__table_id__" , "11" , $val['url']);
                        $val['url']    =   str_replace("__time__" , time() , $val['url']);
                    }
                    
                    //$relult = ResponseInitiative::news('oo1dNwVtnqPTofrvUooHQHKqRhps' , $material['content']);
        echo "<pre>";
        dump($material);
    }
    
    public function edit_test(){
        
        $this->display();
    }
}


