<?php
namespace Admin\Model;
use Common\Model\BaseModel;

class UserModel extends BaseModel {

    protected $_table = "user";

    public function addUser(){

    }

    public function resetPassword(){

    }

    public function findByName($name){

        $m = M($this->_table);
        return $m->where(["name"=>$name])->find();
    }

    public function isLogin(){
        return C("LOGIN_SESSION");
    }

}