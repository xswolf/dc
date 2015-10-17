<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class PrintModel extends BaseModel  {
    protected $_table = "print";

    public function lists($shopId){
        return M($this->_table)->where(["shop_id" => $shopId])
            ->select();
    }
}