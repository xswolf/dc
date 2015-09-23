<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class GoodsTypeModel extends BaseModel {
    protected $_table = "goods_type";


    public function lists($shopId){
        return M($this->_table)->where(["shop_id" => $shopId])
            ->select();
    }
}