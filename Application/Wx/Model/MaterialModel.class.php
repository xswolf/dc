<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class MaterialModel extends BaseModel{
    
    protected  $tableName = "wx_material";
    
    public function getList(){
        $data = $this->where(['status'=>1])->select();
        
        foreach ($data as &$val){
            $val['content'] = unserialize($val['content']);
        }
        
        return $data;
    }
    
}

