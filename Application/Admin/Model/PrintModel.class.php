<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class PrintModel extends BaseModel  {
    protected $_table = "print";

    public function lists($shopId , $default = false){
        $where = ["shop_id" => $shopId];
        if($default){
            $where['default'] = 1;
        }
        $list = M($this->_table)->where($where)
            ->select();
        return $list;
    }
}