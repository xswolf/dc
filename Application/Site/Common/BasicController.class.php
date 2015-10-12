<?php

/**
 * 前端基础类
 * User: hgh
 * Date: 2015/10/8
 * Time: 16:19
 */
namespace Site\Common;

use Common\Controller\BaseController;

use Site\Common\MemberController as Member;
class BasicController extends BaseController {
	/**
	 * @var int 店铺ID
	 */
	protected $_shop_id;

	/**
	 * @var int 用户id
	 */
	protected $_member_id;

	/**
	 * @param bool 用户信息
	 */
	protected $_member;

	public function _initialize() {
		$this->_shop_id = intval(DomainController::instance()->get('shop_id'));
		if(empty($this->_shop_id)) {
			E('获取店铺ID失败!');
		}

		$this->_member = Member::instance();
		$this->_member->setShopId($this->_shop_id);
		$this->_member->_init();

	}

}