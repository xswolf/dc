<?php
/**
 * 用户信息
 * User: hgh
 * Date: 2015/10/9
 * Time: 10:01
 */
namespace Site\Model;

use Common\Model\BaseModel;
class MemberModel extends BaseModel {
	/**
	 * @var string 用户表
	 */
	protected $_table = 'member';

	/**
	 * @var string 用户店铺信息表
	 */
	protected $_table_member_shop = 'member_shop';

	/**
	 * @param int $mid 用户ID
	 * @param int $shop_id 店铺ID
	 * @return bool or array
	 */
	public function memberInfo($mid, $shop_id) {
		$Model = M($this->_table)->alias('a');
		return $Model->join('__MEMBER_SHOP__ b on a.id = b.mid')
			->field([
				'a.username',
				'a.nickname',
				'a.avatar',
				'a.integral',
				'b.shop_id',
				'b.en_count'
		])->where(['a.id' => $mid, 'a.status' => 1, 'b.shop_id' => $shop_id])->find();
	}
}