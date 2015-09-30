<?php
namespace Admin\Model;
use Common\Model\BaseModel;

class OrderModel extends BaseModel {
    /**
     * @var string 订单表
     */
    protected $_table = 'order';

    /**
     * @var string 订单食物表
     */
    protected $_table_order_goods = 'order_goods';

    /**
     * 订单列表
     * @param int $shop_id
     * @param string $sn
     * @return array
     */
    public function orderList($shop_id, $sn) {
        $M = M($this->_table);
        $w = ['shop_id' => $shop_id, 'status' => 1];
        if(!empty($sn)) {
            $w['sn'] = $sn;
        }
        return $M->where($w)->select();
    }

    /**
     * 订单食物列表
     * @param int $order_id
     * @return array
     */
    public function orderGoodsList($order_id) {
        $condition = ['a.order_id' => $order_id];
        $model = M($this->_table_order_goods)->alias('a');
        $data = $model->join('__GOODS__ b on a.goods_id = b.id')
            ->field([
                'a.goods_id',
                'a.price' => 'order_goods_price',
                'a.number',
                'a.mark',
                'b.name'
            ])->where($condition)->select();
        return $data;
    }

    /**
     * 确认订单
     * @param int $shop_id
     * @param int $order_id
     * @return bool
     */
    public function sureOrder($shop_id, $order_id) {
        return $this->edit(['status' => 2],['shop_id' => $shop_id, 'id' => $order_id]);
    }

}