<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class MaterialModel extends BaseModel{
    
    protected  $tableName = "wx_material";
    
    public function getList($where=[]){
        $_where = ['status'=>1];
        $where = array_merge($_where,$where);
        
        $data = $this->where( $where )->select();
        
        foreach ($data as &$val){
            $val['content'] = unserialize($val['content']);
        }
        
        return $data;
    }
    
}

