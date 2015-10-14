<?php
namespace Wx\Controller;
/**
 * 支付通知
 */

use Wx\WxPay\Notify;
class PayNotifyController extends InitiativeController{
    
    public function index(){
//         $GLOBALS['HTTP_RAW_POST_DATA'] = "<xml><return_code><![CDATA[SUCCESS]]></return_code><transaction_id><![CDATA[12323123133]]></transaction_id><appid><![CDATA[wxcc0739e80478f18a]]></appid><attach><![CDATA[ggg]]></attach><body><![CDATA[高圆圆]]></body><goods_tag><![CDATA[嘎嘎嘎]]></goods_tag><mch_id>1273598501</mch_id><nonce_str><![CDATA[s40ozp2wmqcdheelmtphd33tk1id1lc2]]></nonce_str><notify_url><![CDATA[http://qunian.weiwubao.com/wx/pay_notify]]></notify_url><openid><![CDATA[oo1dNwVtnqPTofrvUooHQHKqRhps]]></openid><out_trade_no>127359850120151014140640</out_trade_no><spbill_create_ip><![CDATA[127.0.0.1]]></spbill_create_ip><time_expire>20151014141640</time_expire><time_start>20151014140640</time_start><total_fee>1</total_fee><trade_type><![CDATA[JSAPI]]></trade_type><sign><![CDATA[42CECC0B80488A7F42B888A525A992C1]]></sign></xml>";
        $notify = new Notify();
        $notify->Handle(false);
    }
 //return_code    transaction_id
}

