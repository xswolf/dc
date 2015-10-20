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
	 * @var string 用户表
	 */
	protected $_table_member = 'member';

	/**
	 * @var string 支付通知日志表
	 */
	protected $_table_pay_notice_log = 'pay_notice_log';

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
	 * @param array $where
	 * @return array
	 */
	public function getOrder($order_id, $where = ['status' => 1]) {
		$db = new Model();
		$w = array_merge(['id' => $order_id], $where);
		return $db->table($this->_table)->where($w)->find();
	}

	/**
	 * 获取微信用户表ID
	 * @param int $member_id
	 * @return array
	 */
	public function getWxUser($member_id) {
		if($member_id) {
			$Model = M($this->_table_member)->alias('a');
			return $Model->join('__WX_USER__ b on a.wx_user_id = b.id')
				->field([
					'b.id'
				])->where(['a.id' => $member_id, 'b.subscribe' => 1])->find();
		}
	}

	/**
	 * 支付日志
	 * @param int $shop_id
	 * @param int $order_id
	 * @param string $message
	 * @return bool
	 */
	public function payLog($shop_id, $order_id, $message) {
		$M = M($this->_table_pay_notice_log);
		return $M->add([
			'shop_id' => $shop_id,
			'order_id' => $order_id,
			'message' => $message,
			'created_at' => NOW_TIME
		]);
	}

	/**
	 * 支付成功,改变订单状态
	 * @param int $order_id
	 * @return bool
	 */
	public function changeOrderStatus($order_id) {
		$flag = false;
		if($order_id) {
			$db = new Model();
			$flag = $db->table($this->_table)->where(['id' => $order_id])->save(['status' => 2]);
		}
		return $flag;
	}
}