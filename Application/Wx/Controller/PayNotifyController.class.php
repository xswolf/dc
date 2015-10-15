<?php
namespace Wx\Controller;
/**
 * 支付通知
 */

use Wx\WxPay\Notify;
class PayNotifyController extends InitiativeController{
    
    public function index(){
//         $notify = M("test")->field("test")->find();
//         $data = json_decode($notify['test'],true);
//         $xml = "<xml>";
//         foreach ($data as $key=>$val)
//         {
//             if (is_numeric($val)){
//                 $xml.="<".$key.">".$val."</".$key.">";
//             }else{
//                 $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
//             }
//         }
//         $xml.="</xml>";
//         $GLOBALS['HTTP_RAW_POST_DATA'] = $xml;
        
        $notify = new Notify();
        $result = $notify->Handle(false);
        if($result){
            $data = [
                'pay_time'  =>  strtotime($result['time_end']),
                'status'    =>  1,
                'wx_pay_sn' =>  $result['transaction_id'],
            ];
            $M = M("wx_pay_log")->where(['openid'=>$result['openid'],'order_sn'=>$result['out_trade_no']]);
            if( $M->save($data) ){
                //TODO 通知
                
                //修改通知状态
                $M->save( ['is_send'=>1] );
            }
        }
    }
}

