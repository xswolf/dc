<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class ShopTableModel extends BaseModel {
    protected $_table = "shop_table";

    public function lists($shopId){
        return M($this->_table)
            ->where(['shop_id'=>$shopId])
            ->select();
    }
}