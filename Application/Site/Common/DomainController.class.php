<?php
/**
 * User: hgh
 * Date: 2015/10/8
 * Time: 16:41
 */

namespace Site\Common;

use Common\Controller\BaseController;

class DomainController extends BaseController {

	protected $_config = [
		'enable' => false,
		'rule'   => ['shop_id' => 0], //规则, 如:['shop_id'=>0]
		'merge_to_get' => false, // 是否合并到$_GET中
	];

	protected $_params = [];

	protected function _initialize() {
		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
		$host = explode('.', $host);
		foreach ($this->_config['rule'] as $name => $index) {
			$this->_params[$name] = isset($host[$index])? $host[$index] : null;
		}

		// 合并到GET中
		if ($this->_config['merge_to_get']) {
			foreach ($this->_params as $k => $v) {
				$_GET[$k] = $v;
			}
		}
	}

	public function get($name, $default = null) {
		return isset($this->_params[$name])? $this->_params[$name] : $default;
	}
}