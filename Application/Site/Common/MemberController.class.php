<?php
/**
 * 用户信息控制器
 * User: hgh
 * Date: 2015/10/9
 * Time: 9:16
 */

namespace Site\Common;

use Common\Controller\BaseController;
use Site\Model\MemberModel;
use Site\Model\ShopTableModel as ShopTable;
class MemberController extends BaseController {
	const browser_key = 'qulian';

	protected $_config = [
		'member_table_lifetime' => 3600,//用户桌号信息保存时间
		'cookie_prefix' => 'qulian_'
	];

	/**
	 * @var int 店铺ID
	 */
	protected $_shop_id;

	/**
	 * 初始化用户信息
	 */
	public function _init() {
		self::_assert($this->_shop_id and true);
		$hasHandled = false;
		$mid = I('get.mid');
		if(!empty($mid) && ctype_digit($mid)) {
			$wx_user = MemberModel::instance()->getWxUsrInfo($mid);
			if(!empty($wx_user)) {
				$member = MemberModel::instance()->memberInfo($mid, $this->_shop_id);
				if(!empty($member) and $member['shop_id'] == $this->_shop_id) {
					$member_id = $member['id'];
					$member_username = $member['username'];
					$member_avatar = $member['avatar'];
				} else {
					$member_id = MemberModel::instance()->addMember($wx_user, $this->_shop_id);
					$member_username = $wx_user['nickname'];
					$member_avatar = $wx_user['headimgurl'];
				}
				$hasHandled = true;
				cookie('mid', $member_id, ['expire' => NOW_TIME + 31536000, 'prefix' => $this->_config['cookie_prefix']]);
				cookie('username', $member_username, ['expire' => NOW_TIME + 31536000, 'prefix' => $this->_config['cookie_prefix']]);
				cookie('avatar', $member_avatar, ['expire' => NOW_TIME + 31536000, 'prefix' => $this->_config['cookie_prefix']]);
			}
		}

		$time = I('get.time');
		if(!empty($time) && ctype_digit($time)) {
			if(NOW_TIME - $time < $this->_config['member_table_lifetime']) {
				$table = I('get.table');
				if (!empty($table) and ctype_digit($table)) {
					$hasHandled = true;
					$tid = intval($table);
					if ($tid) {
						$table = ShopTable::instance()->get($tid,$this->_shop_id);
						if ($table and $table['shop_id'] == $this->_shop_id) {
							cookie('table_id', $table['id'], ['expire' => $this->_config['member_table_lifetime'], 'prefix' => $this->_config['cookie_prefix']]);
							cookie('table_name', $table['name'], ['expire' => $this->_config['member_table_lifetime'], 'prefix' => $this->_config['cookie_prefix']]);
						}
					}
				}
			}
		}

		$shop_info = ShopTable::instance()->getShopName($this->_shop_id);
		if(!empty($shop_info) && is_array($shop_info)) {
			$shop_name = $shop_info['shop_name'];
			cookie('shop_name', $shop_name, ['expire' => NOW_TIME + 31536000, 'prefix' => $this->_config['cookie_prefix']]);
		}

		$browser = I('get.browser');
		if(!empty($browser) && $browser == self::browser_key) {
			cookie('browser', $browser, ['expire' => NOW_TIME + 31536000, 'prefix' => $this->_config['cookie_prefix']]);
		}
		return $hasHandled;
	}

	/**
	 * @param int $shop_id
	 */
	public function setShopId($shop_id) {
		$this->_shop_id = $shop_id;
	}

	private function _assert($condition, $error = null) {
		if (APP_DEBUG and $condition === false) {
			$error = $error ? $error : 'Assert failed.';
			E($error);
		}
	}
}