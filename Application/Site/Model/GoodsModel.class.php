<?php
/**
 * 商品model
 * User: hgh
 * Date: 2015/10/13
 * Time: 10:02
 */

namespace Site\Model;

use Common\Model\BaseModel;
class GoodsModel extends BaseModel {
	/**
	 * @var string 商品分类表
	 */
	protected $_table = 'goods_category';

	/**
	 * @var string 商品表
	 */
	protected $_table_goods = 'goods';

	/**
	 * 获取当前店铺的商品分类
	 * @param int $shop_id
	 * @return array
	 */
	public function goodsCategory($shop_id) {
		$Model = M($this->_table);
		return $Model->field(['id','shop_id','name'])->where(['shop_id' => $shop_id, 'status' => 1])->order('id ASC')->select();
	}

	/**
	 * 获取选中分类下的商品
	 * @param int $category_id
	 * @return array
	 */
	public function goodsCategoryGoods($category_id) {
		$Model = M($this->_table_goods);
		return $Model->where(['category_id' => $category_id, 'status' => 1])->select();
	}

	/**
	 * 获取当前店铺默认的第一个商品分类ID
	 * @param int $shop_id
	 * @return array
	 */
	public function getDefaultCategoryId($shop_id) {
		$Model = M($this->_table);
		return $Model->field(['id','name'])->where(['shop_id' => $shop_id, 'status' => 1])->order('id ASC')->limit(1)->find();
	}

	/**
	 *获得某个店铺商品的列表
	 * @param int $shop_id
	 * @param array $gid
	 * @return array
	 */
	public function selectGoodsByIds($shop_id, $gid) {
		$data = $Model = M($this->_table)->alias('a')
			->join("__GOODS__ b on a.id = b.category_id")
			->field([
				'a.shop_id',
				'a.name' => 'category_name',
				'b.id',
				'b.name' => 'goods_name',
				'b.native_price',
				'b.price',
				'b.status'
			])
			->where(['a.shop_id' => $shop_id, 'b.id' => ['in',$gid]])
			->select();
		return $data;
	}

}