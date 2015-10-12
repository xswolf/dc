<?php
/**
 * 商品列表首页
 * User: hgh
 * Date: 2015/10/9
 * Time: 13:14
 */

namespace Site\Controller;

use Common\Controller\BaseController;
class GoodsController extends BaseController {
	/**
	 * 首页
	 */
	public function index() {
		$this->display();
	}
}