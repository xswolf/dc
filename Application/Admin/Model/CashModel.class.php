<?php
namespace Admin\Model;
use Common\Model\BaseModel;

class CashModel extends BaseModel {

    protected $_table = "cash";
    protected $_cash_log_table = 'cash_log';

    public function lists($shopId , $status = 0){
        return M($this->_table)->where(["shop_id" => $shopId , "status"=>$status])
            ->select();
    }

    // 提现申请
    public function cash($shopId){
        $time = time();
        $list = $this->lists($shopId);
        $cashMoney = 0;
        $ids = [];
        foreach ($list as $v){
            $cashMoney += $v['cash_money'];
            $ids[] = $v['id'];
        }
        $data = [
            "cash_money" => $cashMoney,
            "created_at" => $time,
            'status'     => 0,
            'shop_id'    => $shopId
        ];

        $this->startTrans(); //启动事物

        $flag1 = $this->insert($data , $this->_cash_log_table);

        $flag2 = $this->edit(['status'=>1 , 'cash_time' =>$time ] , $ids);

        if ($flag1 && $flag2){
            $this->commit();
            return true;
        }

        $this->rollback();
        return false;

    }

    // 申请提现记录
    public function cashList($shopId = '' , $status=0){
        if ($shopId){
            $where = ['shop_id' => $shopId];
            return M($this->_cash_log_table)->where($where)
                ->select();
        }else{
            return M($this->_cash_log_table)->alias("l")
                ->join("__PLATFORM_SHOP__ s on l.shop_id = s.id")
                ->field("l.id,l.cash_money,l.created_at,s.id as shop_id,s.name")
                ->where(['l.status'=>$status])
                ->select();
        }

    }

}