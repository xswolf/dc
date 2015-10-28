<?php
/**
 * 订单通知类 修改订单状态
 * User: hgh
 * Date: 2015/10/14
 * Time: 9:35
 */

namespace Site\Controller;

use Common\Controller\BaseController;
use Site\Model\OrderModel;
class NoticeController extends BaseController {
	/**
	 * 订单支付成功,微信通知
	 *
	 * @param int $order_id 订单ID
	 * @param float $pay_price
	 * @param int $shop_id
	 * @return array
	 */
	public function pay_notice($order_id, $pay_price, $shop_id) {
		$message = 'Got paid info: ' . json_encode(func_get_args());
		OrderModel::instance()->payLog($shop_id, $order_id, $message);
		$order = OrderModel::instance()->getOrder($order_id);
		if(!$order) {
			return ['message' => "{$order_id}无效订单",'success' => -1];
		}

		if ( ! $this->float_cmp(intval($pay_price), intval($order['price']*100))) {
			return ['message' => "{$order_id}订单价格不对",'success' => -1];
		}

		if($order['status'] == 2) {
			return ['message' => "订单已支付",'success' => 1];
		}

		$flag = OrderModel::instance()->changeOrderStatus($order_id);
		if($flag) {
			return ['message' => "通知成功",'success' => 1];
		}

		return ['message' => "通知失败",'success' => -1];
	}

	private function float_cmp($f1, $f2, $precision = 10) {
		$e = pow(10, $precision);
		$i1 = intval($f1 * $e);
		$i2 = intval($f2 * $e);
		return ($i1 == $i2);
	}
}