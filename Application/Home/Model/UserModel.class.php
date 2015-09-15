<?php
namespace Home\Model;
use Common\Model\BaseModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 9:22
 */

class UserModel extends BaseModel{

    protected $_table = "user";

    public function register($data){

        return $this->insert($data);
    }
}