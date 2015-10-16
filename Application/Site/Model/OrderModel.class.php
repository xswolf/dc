<?php
/**
 * 订单model
 * User: hgh
 * Date: 2015/10/16
 * Time: 10:02
 */


namespace Site\Model;

use Common\Model\BaseModel;
use Think\Model;

class OrderModel extends BaseModel {
	/**
	 * @var string 订单表
	 */
	protected $_table = 'w_order';

	/**
	 * @var string 订单商品表
	 */
	protected $_table_order_goods = 'w_order_goods';

	/**
	 * 生成订单
	 * @param $order
	 * @param $goods
	 * @return array
	 */
	public function create($order, $goods) {
		$db = new Model();
		$db->startTrans();
		$order_id = $db->table($this->_table)->add($order);
		$status = false;
		if($order_id) {
			foreach ($goods as $g) {
				$g['order_id'] = $order_id;
				$flag = $db->table ($this->_table_order_goods)->add($g);
			}
			if($flag) {
				$db->commit();
				$status = true;
			}
		}

		if(!$status) {
			$db->rollback();
		}

		return $order_id;
	}

	/**
	 * 获取订单
	 * @param int $order_id
	 * @return array
	 */
	public function getOrder($order_id) {
		$db = new Model();
		return $db->table($this->_table)->where(['id' => $order_id, 'status' => 1])->find();
	}
}