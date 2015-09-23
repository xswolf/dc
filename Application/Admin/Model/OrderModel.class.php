<?php
namespace Admin\Model;
use Common\Model\BaseModel;

class OrderModel extends BaseModel {
    /**
     * @var string 订单表
     */
    protected $_table = "order";

    /**
     * 订单列表
     * @param int $shop_id
     * @return array
     */
    public function orderList($shop_id) {

    }
}