<?php
namespace Common\Model;

class UserModel extends BaseModel {

    protected $_table = "user";

    protected $_shop_table = "platform_shop";

    protected $user = null;

    protected $userShop = null;

    public function addUser(){

    }

    public function resetPassword(){

    }

    public function findByName($name){

        $m = M($this->_table);
        return $m->where(["name"=>$name , "status"=>1])->find();
    }

    public function isLogin(){
//        session(C("LOGIN_SESSION") , ['id'=>1]);
        return session(C("LOGIN_SESSION"));
    }

    public function setUser($user){
        $this->user = $user;
        $this->userShop = M($this->_shop_table)->where(['uid' => $this->user['id']])->find();

    }

    public function getId(){
        return $this->user['id'];
    }

    public function getShopId(){

        return $this->userShop['id'];
    }

    public function getShopName(){

        return $this->userShop['name'];
    }

    public function getShopStatus(){

        return $this->userShop['status'];
    }

}