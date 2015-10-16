<?php

/**
 * 订单列表
 * User: hgh
 * Date: 2015/10/14
 * Time: 9:35
 */
namespace Site\Controller;

use Common\Controller\BaseController;

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
			$this->ajaxSuccess(['id' => 1]);
		}
	}

}