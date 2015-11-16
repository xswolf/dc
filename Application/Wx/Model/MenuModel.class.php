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
        return $this->menu($data);
    }
    
    private function menu($data , $pid=0){
        $arr = [];
        foreach($data as $val){
            if($val['type']=='click' && $val['group']=='img'){
                $val['type'] = 'media_id';
            }
            if($val['pid']==$pid){
                $val['child'] = $this->menu($data , $val['id']);
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
    
    /**
     * 删除
     */
    public function del( $id ){
        $pid = $this->where(['id'=>$id])->field("pid")->find();
        if( empty($pid['pid']) ){
            $this->where(['pid'=>$id])->delete();
        }
        return $this->where(['id'=>$id])->delete();
    }
    
}

