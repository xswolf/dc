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
	/**
	 * 订单列表首页
	 */
	public function index() {
		$username = cookie($this->cookie_prefix.'username');
		$table_id = cookie($this->cookie_prefix.'table_id');
		$mid = cookie($this->cookie_prefix.'mid');
		if(!($username and ctype_digit($table_id) and ctype_digit($mid))) {
			E('获取信息失败!');
		}
		$this->assign('username', $username);
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
					$wx_pay = PayEvent::instance()->JsApiPay($wx_usr['id'],$order['sn'],$order['price']*100,'商品支付');
					if($wx_pay['status'] == 1) {
						$this->assign('jsApiParameters', $wx_pay['message']);
					} else {
						E("{$wx_pay['message']}");
					}
				} else {
					E('查无此微信账号');
				}
			}

			$this->assign('price', $order['price']);
		}
		$this->display();
	}

	protected function createSn() {
		return date('YmdHis' . sprintf('%04d', mt_rand(0, 1000)));
	}

}