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
    
    public function edit($data){
        usort($data['content'], function($a , $b){
            if($a['sort'] == $b['sort']){
                return 0;
            }
            return $a['sort'] < $b['sort'] ? -1 : 1;
        });
        $data['content'] = serialize($data['content']);
        if( !empty($data['id']) ){
            $id = $data['id'];
            unset($data['id']);unset($data['status']);unset($data['key']);unset($data['created_at']);
            return $this->where(['id'=>$id])->save($data);
        }else{
            $data['created_at'] = NOW_TIME;
            return $this->add($data);
        }
    }
    
    public function del($id){
        return $this->where(['id'=>$id])->save(['status'=>-1]);
    }
}

