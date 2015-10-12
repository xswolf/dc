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
	 * @return bool
	 */
	public function get($table_id) {
		$Model = M($this->_table);
		return $Model->where(['id' => $table_id, 'status' => 1])->find();
	}

}