<?php
namespace Wx\Controller;
/**
 * 用来处理微信交互需要处理的数据
 */

use Think\Controller;
use LaneWeChat\Core\Wechat;
class BaseController extends Controller{
    
    public function _initialize(){

//         $signature = $_GET["signature"];
//         $timestamp = $_GET["timestamp"];
//         $nonce = $_GET["nonce"];
        
//         $token = "youcan1";
//         $tmpArr = array($token, $timestamp, $nonce);
//         sort($tmpArr, SORT_STRING);
//         $tmpStr = implode( $tmpArr );
//         $tmpStr = sha1( $tmpStr );
        
//         if( $tmpStr == $signature ){
//             echo $_GET["echostr"];
//         }else{
//             return false;
//         }
//         exit;

        $wechat = new Wechat(WECHAT_TOKEN, TRUE);
        echo $wechat->run();
    }
}

