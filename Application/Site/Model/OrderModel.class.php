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

	protected $_table_order = 'order';

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
	 * @var string 微信用户关注表
	 */
	protected $_table_wx_user = 'wx_user';

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
	 * 获取订单详情
	 * @param int $order_id
	 * @return array
	 */
	public function getOrderView($order_id) {
		$M = M($this->_table_order)->alias('a');
		$data = $M->join('__ORDER_GOODS__ b on a.id = b.order_id')
			->join('__GOODS__ c on b.goods_id = c.id')
			->join('__PLATFORM_SHOP__ d on a.shop_id = d.id')
			->field([
				'a.price' => 'order_price',
				'a.pay_type',
				'a.status',
				'a.created_at',
				'b.price' => 'order_goods_price',
				'b.mark',
				'b.number',
				'c.name' => 'goods_name',
				'd.name' => 'shop_name'
			])->where(['a.id' => $order_id])->select();
		return $data;
	}

	/**
	 * 订单列表
	 * @param int $wx_user_id
	 * @return array
	 */
	public function getOrderList($wx_user_id) {
		$Model = M($this->_table_member)->alias('a');
		$list = $Model->join('__ORDER__ b on a.id = b.mid')
			->join('__ORDER_GOODS__ c on b.id = c.order_id')
			->join('__GOODS__ d on c.goods_id = d.id')
			->join('__PLATFORM_SHOP__ e on b.shop_id = e.id')
			->field([
				'b.id' => 'order_id',
				'b.shop_id',
				'b.price' => 'order_price',
				'b.created_at' => 'order_created_at',
				'b.status' => 'order_status',
				'd.name' => 'goods_name',
				'd.pic1' => 'goods_img',
				'e.name' => 'shop_name',
				'e.logo'
			])->where(['a.wx_user_id' => $wx_user_id])->group('b.id')->order('b.id DESC')->select();
		//echo $Model->getlastSql();
		//exit;
		return $list;
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
	 * 通过openid,获取微信用户ID
	 * @param string $openid
	 * @return array
	 */
	public function getWxId($openid) {
		return M($this->_table_wx_user)->field(['id'])->where(['openid' => $openid])->find();
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