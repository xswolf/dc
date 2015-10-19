<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class MenuModel extends BaseModel{
    
    protected  $tableName = "wx_menu";
    
    
    /**
     * 获取某级菜单数量
     */
    public function getMenuSum( $pid = 0 ){
        return $this->where(['pid'=>$pid , 'status'=>1])->count();
    }
    
    
}

