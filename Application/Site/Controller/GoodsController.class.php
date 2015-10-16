<?php
/**
 * 商品列表首页
 * User: hgh
 * Date: 2015/10/9
 * Time: 13:14
 */

namespace Site\Controller;

use Site\Common\BasicController;
use Site\Common\DomainController;
use Site\Model\GoodsModel;
class GoodsController extends BasicController {
	/**
	 * @var int 店铺ID
	 */
	protected $_shop_id;

	/**
	 * 首页
	 */
	public function index() {
		$this->display();
	}

	/**
	 * 商品列表
	 */
	public function goods_list() {
		$id = I('get.id');
		if(!empty($id) && ctype_digit($id)) {

		}
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
		if(!empty($id) && ctype_digit($id)) {
			$goods = GoodsModel::instance()->goodsCategoryGoods($id);
		} else {
			$this->_shop_id = intval(DomainController::instance()->get('shop_id'));
			$category = GoodsModel::instance()->getDefaultCategoryId($this->_shop_id);
			if(!empty($category)) {
				$goods = GoodsModel::instance()->goodsCategoryGoods($category['id']);
			}
		}
		$this->ajaxSuccess($goods);
	}

}