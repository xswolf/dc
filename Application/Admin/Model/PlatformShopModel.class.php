<?php
namespace Admin\Model;

use Common\Model\BaseModel;
use Common\Model\UserModel;

class PlatformShopModel extends BaseModel
{

    protected $_table = "platform_shop";

    public function getList()
    {
        $m = M($this->_table);

        return $m->alias("s")
            ->join('__USER__ u on s.uid=u.id')
            ->field('s.name as shopName , u.id,u.name , s.status')
            ->select();
    }

    public function addShop($data)
    {
        $m = M($this->_table);
        $m->startTrans();
        $dataShop           = $data;
        $data['password']   = processPwd($data['password']);
        $dataShop['name']   = $data['shopName'];

        $mu = M('user');
        if ($mu->create($data)) {
            $flag2 = $mu->add();
        }

        $dataShop['uid']        = $flag2;
        $dataShop['created_at'] = time();
        if ($m->create($dataShop)) {
            $flag1 = $m->add();
        }

        if ($flag1 && $flag2) {
            $m->commit();

            return true;
        } else {
            $m->rollback();
        }

        return false;
    }

    public function editShop($id  , $data){
        PlatformShopModel::instance()->where(['uid'=>$id])->setField("name" , $data['shopName']);
        UserModel::instance()->where(['id'=>$id])->setField("tel" , $data['tel']);
        if($data['password'] != ''){
            UserModel::instance()->where(['id'=>$id])->setField("tel" , $data['password']);
        }

    }

}