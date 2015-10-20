<?php
namespace Wx\Controller;
/**
 * 支付通知
 */

use Wx\WxPay\Notify;
use Common\Controller\BaseController;
use Site\Controller\OrderController;
class PayNotifyController extends BaseController{
    
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
            if( M("wx_pay_log")->where(['openid'=>$result['openid'],'order_sn'=>$result['out_trade_no']])->save($data) ){
                //TODO 通知暂时放下
                $res = OrderController::instance()->pay_notice($result['out_trade_no'], $result['total_fee'], $result['attach']);
                if($res['success']==1){
                    //修改通知状态
                    M("wx_pay_log")->where(['openid'=>$result['openid'],'order_sn'=>$result['out_trade_no']])->save( ['is_send'=>1] );
                }
            }
        }
    }
}

