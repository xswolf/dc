<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class UserModel extends BaseModel{
    
    public function insertUser( $openId ){
        $userInfo = wx_get_user_info($openId);
        
    }
    
}

