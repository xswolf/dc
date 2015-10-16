<?php
namespace Admin\Model;
use Common\Model\BaseModel;

/**
 * Class GoodsCategoryModel
 * @package Admin\Model
 * TODO 档口分类预留
 */
class GoodsCategoryModel extends BaseModel  {

    protected $_table = "goods_category";

    public function lists($shopId){
        return M($this->_table)->where(["shop_id" => $shopId])
            ->select();
    }
}