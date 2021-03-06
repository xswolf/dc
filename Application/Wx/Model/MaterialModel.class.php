<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class MaterialModel extends BaseModel{
    
    protected  $tableName = "wx_material";
    
    public function getCount($where=[]){
        $_where = ['status'=>1];
        $where = array_merge($_where,$where);
        return $this->where($_where)->count();
    }
    
    public function getList($where=[],$limit="0,20"){
        $_where = ['status'=>1];
        $where = array_merge($_where,$where);
        
        $data = $this->where( $where )->limit($limit)->select();
        
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
        foreach($data['content'] as &$val){
            foreach($val as $k=>$v){
                if(!in_array($k, ['picurl','url','title','description'])){
                   unset($val[$k]);
                }
            }
        }
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

