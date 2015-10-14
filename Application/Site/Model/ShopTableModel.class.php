<?php
/**
 * 店铺桌号
 * User: hgh
 * Date: 2015/10/9
 * Time: 11:12
 */

namespace Site\Model;

use Common\Model\BaseModel;
class ShopTableModel extends BaseModel {
	/**
	 * @var string 店铺桌号表
	 */
	protected $_table = 'shop_table';

	/**
	 * @param int $table_id
	 * @param int $shop_id
	 * @return bool
	 */
	public function get($table_id, $shop_id) {
		$Model = M($this->_table);
		return $Model->where(['id' => $table_id, 'shop_id' => $shop_id, 'status' => 1])->find();
	}

}