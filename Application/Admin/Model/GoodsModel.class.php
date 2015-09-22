<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class GoodsModel extends BaseModel  {
    protected $_table = "goods";

    public function lists($shopId){
        return M($this->_table)->where(["shop_id" => $shopId])
            ->select();
    }
}