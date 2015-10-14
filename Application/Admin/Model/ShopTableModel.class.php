<?php
namespace Admin\Model;
use Common\Model\BaseModel;
class ShopTableModel extends BaseModel {
    protected $_table = "shop_table";

    public function lists($shopId){
        return M($this->_table)
            ->alias("t")
            ->join("__WX_QRCODE__ q on t.qrcode_id = q.id")
            ->field("t.id,t.name,q.url")
            ->where(['t.shop_id'=>$shopId])
            ->select();
    }
}