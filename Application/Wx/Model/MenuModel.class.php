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
        $data = $this->where(["status"])->order("sort DESC")->select();
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
    
    /**
     * 排序
     */
    public function sort($id , $level){
        if( $level == 1 ){
            $where = ["pid"=>0];
        }else{
            $pid = $this->where(['id'=>$id])->field("pid")->find();
            $where = ["pid"=>$pid['pid']];
        }
        $sort = $this->where($where)->field("sort")->order("sort DESC")->find();
        if($sort){
            $sort = $sort['sort'] + 1;
            $rel = $this->where(['id'=>$id])->save( ['sort'=>$sort]);
            if($rel !== false)
                return $sort;
        }
        return false;
    }
    
}

