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
    
    /**
     * 获取菜单列表
     */
    public function getMenuList(){
        $data = $this->where(["status"])->select();
        $arr = [];
        foreach($data as $val){
            if($val['pid']==0){
                $val['child'] = [];
                foreach($data as $v){
                    if($v['pid'] == $val['id']){
                        array_push($val['child'], $v);
                    }
                }
                $arr[] = $val;
            }
        }
        return $arr;
    }
}

