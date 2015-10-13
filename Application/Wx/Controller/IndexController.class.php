<?php
namespace Wx\Controller;

use LaneWeChat\Core\Wechat;
use Common\Controller\BaseController;
class IndexController extends BaseController{
    
    public function _initialize(){
        
//         $this->verifyToken();

        $wechat = new Wechat(WECHAT_TOKEN, TRUE);
        echo $wechat->run();
    }
    
    
    public function index(){
        
    }
    
    
    public function verifyToken(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        $token = WECHAT_TOKEN ;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            echo $_GET["echostr"];
        }else{
            return false;
        }
        exit;
    }
}

