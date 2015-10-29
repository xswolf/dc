<?php
/**
 * 商品列表首页
 * User: hgh
 * Date: 2015/10/9
 * Time: 13:14
 */

namespace Site\Controller;

use Common\Controller\BaseController;
use Site\Common\DomainController;
use Site\Model\GoodsModel;
class GoodsController extends BaseController {
	/**
	 * @var string cookie前缀
	 */
	protected $cookie_prefix = 'qulian_';

	/**
	 * @var int 店铺ID
	 */
	protected $_shop_id;

	public function _initialize() {
		$browser = cookie($this->cookie_prefix.'browser');
		if(!$browser) {
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
				E('请在微信客户端打开!');
			}
		}
		$shop_name = cookie($this->cookie_prefix.'shop_name');
		$this->assign('shop_name',$shop_name);
	}

	/**
	 * 首页
	 */
	public function index() {
		$this->display();
	}

	/**
	 * 获取商品分类
	 */
	public function get_goods_category() {
		$this->_shop_id = intval(DomainController::instance()->get('shop_id'));
		$category = [];
		if($this->_shop_id) {
			$category = GoodsModel::instance()->goodsCategory($this->_shop_id);
		}
		$this->ajaxSuccess($category);
	}

	/**
	 * 获取点击分类下的商品列表
	 */
	public function get_category_goods() {
		$id = I('get.id');
		$goods = [];
		$this->_shop_id = intval(DomainController::instance()->get('shop_id'));
		if(!empty($id) && ctype_digit($id)) {
			$goods = GoodsModel::instance()->goodsCategoryGoods($id, $this->_shop_id);
		} else {
			$category = GoodsModel::instance()->getDefaultCategoryId($this->_shop_id);
			if(!empty($category)) {
				$goods = GoodsModel::instance()->goodsCategoryGoods($category['id'], $this->_shop_id);
			}
		}
		$this->ajaxSuccess($goods);
	}

}