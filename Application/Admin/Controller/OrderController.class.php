<?php
namespace Admin\Controller;
use Common\Controller\VerifyController;

use Admin\Model\OrderModel;
class OrderController extends VerifyController {
    /**
     * @var int 平台ID
     */
    protected $platform_id;

    /**
     * @var int 店铺ID
     */
    protected $shop_id;

    public function _before_order() {
        $this->shop_id = $this->user->getShopId();
    }

    public function index(){
        $this->display();
    }

    /**
     * 商家管理平台 -> 当前订单
     */
    public function order() {
        $data = OrderModel::instance()->orderList($this->shop_id);
        if(is_array($data)) {
            foreach($data as &$list) {
                $list['orderTime'] = $this->time_tran($list['created_at']);
                $list['orderGoodsList'] = OrderModel::instance()->orderGoodsList($list['id']);
            }
        }
        $this->assign('data',$data);
        $this->display();
    }

    private function time_tran($the_time){
        $t=time()-$the_time;
        $f=[
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        ];
        foreach ($f as $k=>$v)    {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

}