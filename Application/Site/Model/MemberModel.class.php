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
	 * @var string 微信用户表
	 */
	protected $_table_wx_user = 'w_wx_user';

	/**
	 * @param int $wx_uid 微信表用户ID
	 * @param int $shop_id 店铺ID
	 * @return bool or array
	 */
	public function memberInfo($wx_uid, $shop_id) {
		/*$Model = M($this->_table)->alias('a');
		return $Model->join('__MEMBER_SHOP__ b on a.id = b.mid')
			->field([
				'a.username',
				'a.nickname',
				'a.avatar',
				'a.integral',
				'b.shop_id',
				'b.en_count'
		])->where(['a.id' => $mid, 'a.status' => 1, 'b.shop_id' => $shop_id])->find();*/
		$Model = M($this->_table);
		return $Model->field([
			'id',
			'username',
			'nickname',
			'avatar',
			'integral',
			'shop_id'
		])->where(['wx_user_id' => $wx_uid, 'shop_id' => $shop_id])->find();
	}

	/**
	 * 记录微信用户信息
	 * @param array $wx
	 * @param int $shop_id
	 * @return bool
	 */
	public function addMember($wx, $shop_id) {
		if(is_array($wx)) {
			$in_data = [
				'shop_id' => $shop_id,
				'wx_user_id' => $wx['id'],
				'username' => $wx['nickname'],
				'nickname' => $wx['nickname'],
				'avatar' => $wx['headimgurl'],
				'tel' => '',
				'sex' => $wx['sex'],
				'integral' => 0,
				'address' => $wx['country'].'-'.$wx['province'].'-'.$wx['city'],
				'created_at' => NOW_TIME
			];
			$member_id = M($this->_table)->add($in_data);
			return $member_id;
		}
		return false;
	}

	/**
	 * @param int $mid 微信用户ID
	 * @return array
	 */
	public function getWxUsrInfo($mid) {
		$db = new Model();
		return $db->table($this->_table_wx_user)->where(['id' => $mid])->find();
	}
}