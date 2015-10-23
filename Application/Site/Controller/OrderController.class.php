<?php

/**
 * 订单列表
 * User: hgh
 * Date: 2015/10/14
 * Time: 9:35
 */
namespace Site\Controller;

use Common\Controller\BaseController;
use Site\Common\DomainController;
use Wx\Event\PayEvent;
use Site\Model\GoodsModel;
use Site\Model\OrderModel;
class OrderController extends BaseController {
	/**
	 * @var string cookie前缀
	 */
	protected $cookie_prefix = 'qulian_';

	public function _initialize() {
		$browser = cookie($this->cookie_prefix.'browser');
		if(!$browser) {
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
				E('请使用微信浏览器访问');
			}
		}
		$shop_name = cookie($this->cookie_prefix.'shop_name');
		$this->assign('shop_name',$shop_name);
	}

	/**
	 * 订单列表首页
	 */
	public function index() {
		$username = cookie($this->cookie_prefix.'username');
		$table_id = cookie($this->cookie_prefix.'table_id');
		$mid = cookie($this->cookie_prefix.'mid');
		if(!($username and ctype_digit($mid))) {
			E('获取信息失败!');
		}

		$this->assign('username', json_decode($username,true));
		$this->assign('table_id', $table_id);
		$this->assign('mid', $mid);
		$this->display();
	}

	/**
	 * 提交订单
	 */
	public function submit() {
		if (IS_AJAX and IS_POST) {
			$mid = cookie($this->cookie_prefix.'mid');
			if(empty($mid)) {
				$this->ajaxError(['msg' => '用户信息失效,请重新扫描二维码']);
			}
			list($order, $goods) = $this->_handelOrder();
			$res = OrderModel::instance()->create($order, $goods);
			if ($res) {
				$this->ajaxSuccess(['id' => $res]);
			} else {
				$this->ajaxError(['msg' => '订单提交失败']);
			}
		}
	}

	/**
	 * 处理订单
	 */
	protected function _handelOrder() {
		$mid = cookie($this->cookie_prefix.'mid');
		$table_id = cookie($this->cookie_prefix.'table_id');
		/*if(empty($table_id)) {
			$this->ajaxError(['msg' => '桌号失效,请重新扫描二维码']);
		}*/
		$shop_id = intval(DomainController::instance()->get('shop_id'));
		$order = [
			'mid' => $mid,
			'table_id' => empty($table_id) ? 0 : $table_id,
			'platform_id' => 0,
			'shop_id' => $shop_id,
			'pay_type' => 1,
			'created_at' => NOW_TIME
		];

		$spec = I('post.spec');
		foreach ($spec as $s) {
			$gid[] = $s['gid'];
		}
		$sGoods = GoodsModel::instance()->selectGoodsByIds($shop_id, $gid);
		$goods = [];
		foreach ($sGoods as $g) {
			foreach ($spec as $s) {
				if ($g['id'] == $s['gid']) {
					$number = $s['number'];
					$remark = isset($s['remark']) ? $s['remark'] : '';
					break;
				}
			}
			$goods[] = [
				'order_id' => null,
				'goods_id' => $g['id'],
				'price' => $g['price'],
				'number' => $number,
				'mark' => $remark
			];
			$order['native_price'] += $g['price'] * $number;
		}
		$order['price'] = $order['native_price'];
		$order['sn'] = $this->createSn();
		if (!$goods) {
			$this->ajaxError(['msg' => '购物车为空']);
		}

		return [$order, $goods];
	}

	/**
	 * 订单详情
	 */
	public function order_view() {
		$order_id = intval(I('request.id'));
		$data = [];
		if(!empty($order_id) && is_numeric($order_id)) {
			$data = OrderModel::instance()->getOrderView($order_id);
		}
		$this->assign('data',$data);
		$this->assign('order_id',$order_id);
		$this->display();
	}

	/**
	 * 订单列表
	 */
	public function order_list() {
		$wx_user_id = intval(I('get.mid'));
		$data = OrderModel::instance()->getOrderList($wx_user_id);
		/*$order_list = [];
		if(is_array($data)) {
			foreach($data as $list) {
				$order_list[$list['shop_id']]['header'] = ['shop_name' => $list['shop_name'], 'order_status' => $list['order_status']];
				$order_list[$list['shop_id']][] = $list;
			}
		}*/

		$this->assign('data', $data);
		$this->display();
	}

	/**
	 * 支付
	 * @return bool|string
	 */
	public function pay() {
		$order_id = intval(I('request.id'));
		if(!empty($order_id) && is_numeric($order_id)) {
			$order = OrderModel::instance()->getOrder($order_id);
			if(!$order) {
				E('无效订单');
			}
			if(ctype_digit($order['mid'])) {
				$wx_usr = OrderModel::instance()->getWxUser($order['mid']);
				if(!empty($wx_usr) && is_array($wx_usr)) {
					$wx_pay = PayEvent::instance()->JsApiPay($wx_usr['id'],$order['id'],$order['sn'],$order['price']*100,'商品支付','',$order['shop_id']);
					if($wx_pay['status'] == 1) {
						$this->assign('jsApiParameters', $wx_pay['message']);
					} else {
						E("{$wx_pay['message']}");
					}
				} else {
					E('查无此微信账号');
				}
			}
			$this->assign('shop_id',$order['shop_id']);
			$this->assign('order_id',$order_id);
			$this->assign('price', $order['price']);
		}
		$this->display();
	}

	/**
	 * 支付成功
	 */
	public function success() {
		$order_id = intval(I('request.id'));
		if(!empty($order_id) && is_numeric($order_id)) {
			$order = OrderModel::instance()->getOrder($order_id,[]);
			if(!$order) {
				E('订单不存在');
			}

			switch($order['status']) {
				case 1:
					$message = '订单尚未支付!如果您已经付款,请联系商家.';
					break;
				case 2:
					$message = '支付成功!';
					break;
				case 3:
					$message = '订单已完成';
					break;
			}
			$this->assign('message',$message);
			$this->assign('status',$order['status']);
		}
		$this->assign('order_id', $order_id);
		$this->display();
	}

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

	protected function createSn() {
		return date('YmdHis' . sprintf('%04d', mt_rand(0, 1000)));
	}

}