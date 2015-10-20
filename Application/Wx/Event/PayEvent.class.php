<?php
namespace Wx\Event;

use Wx\WxPay\JsApiPay;
use Wx\Model\UserModel;

use Common\Controller\BaseController;

class PayEvent extends BaseController{

    /**
     * jsapi支付
     * @param string  $user_id    用户id
     * @param string  $order_sn   订单号
     * @param int     $total_fee  费用
     * @param string  $body       商品或支付单简要描述
     * @param string  $goods_tag  商品标记
     * @param string  $attach     自定义数据
     * @return array
     */
    public function JsApiPay( $user_id , $order_id ,$order_sn ,$total_fee , $body='' , $goods_tag='' , $attach='' ){
        if(empty($user_id) || empty($total_fee)){
            return ['status'=> -1 , 'message'=>'数据错误'];
        }
        $tools = new JsApiPay();
        $openId = UserModel::instance()->getOpenId($user_id);
        if(empty($openId)){
            $openId = $tools->GetOpenid();
            //             return ['status'=> -2 , 'message'=>'user_id错误'];
        }
    
    
        $input = new \WxPayUnifiedOrder();
        $input->SetBody( $body );
        $input->SetAttach( $attach );
        $input->SetOut_trade_no( $order_sn );//\WxPayConfig::MCHID.date("YmdHis")
        $input->SetTotal_fee( $total_fee );
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag( $goods_tag );
        $input->SetTrade_type( "JSAPI" );
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
    
        if($order['return_code'] != 'SUCCESS'){
            return ['status'=>-10 , 'message'=>$order['return_msg']];
        }
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $this->addPayLog($openId ,$order_id , $input);
        return ['status'=>1 , 'message'=>$jsApiParameters];
    }
    
    /**
     * 记录支付日志
     */
    private function addPayLog( $openid , $order_id , \WxPayUnifiedOrder $input ){
        $data = [
            'openid'    =>  $openid,
            'order_id'  =>  $order_id,
            'order_sn'  =>  $input->GetOut_trade_no(),
            'body'      =>  $input->GetBody(),
            'total_fee' =>  $input->GetTotal_fee(),
            'attach'    =>  $input->GetAttach(),
            'time_start'=>  strtotime( $input->GetTime_start() ),
            'time_expire'=> strtotime( $input->GetTime_expire() ),
            'pay_time'  =>  0,
            'status'    =>  0,
            'wx_pay_sn' =>  '',
            'is_send'   =>  0,
            'created_at'=>  time(),
        ];
        $M = M("wx_pay_log");
        $rel = $M->where([ "openid"=>$openid,'order_sn'=>$data['order_sn'] ])->select();
        if(empty($rel)){
            $M->add($data);
        }else{
            $M->where([ "openid"=>$openid,'order_sn'=>$data['order_sn']])->save($data);
        }
        
    }
}

