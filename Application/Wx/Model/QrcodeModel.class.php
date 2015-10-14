<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class QrcodeModel extends BaseModel{
    
    protected $tableName = "wx_qrcode";
    
    public function addQrcode($data){
        $M = M($this->tableName);
        if($M->create($data)){
            return $M->add();
        }
        return false;
    }
    
    
    public function getSceneId( $type ){
        $count = M($this->tableName)->where(['type'=>$type])->count();
        return $count + 1;
    }
    
    /**
     * 二维码图片地址
     */
    public function getQrcodeImg( $id ){
        return M($this->tableName)->where(['id'=>$id,'status'=>1])->field('url')->find();
    }
}
