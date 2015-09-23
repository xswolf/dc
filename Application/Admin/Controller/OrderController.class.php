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
        $this->assign('data',$data);
        $this->display();
    }

}