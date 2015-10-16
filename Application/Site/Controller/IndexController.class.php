<?php

/**
 * User: hgh
 * Date: 2015/10/8
 * Time: 16:58
 */
namespace Site\Controller;

use Site\Common\BasicController;
class IndexController extends BasicController {

	public function index() {
		redirect(U('goods/index','',false));
	}
}