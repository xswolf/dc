<?php
namespace Wx\Model;

use Common\Model\BaseModel;

class UserModel extends BaseModel{
    
    protected $_table = "wx_user";
    
    /**
     * 关注 
     */
    public function subscribe( $openId ){
        $userInfo = wx_get_user_info($openId);
        if($userInfo && empty($userInfo['errcode'])){
            $userInfo['nickname'] = encode_emoji($userInfo['nickname']);
            //查询是以前否关注过
            if(M($this->_table)->where(['openid'=>$userInfo['openid']])->find()){
                $this->edit($userInfo , ['openid'=>$userInfo['openid']]);
            }else{
                $this->insert($userInfo);
            }
        }
    }
    
    /**
     * 取消关注
     */
    public function unsubscribe( $openId ){
        $this->edit([ 'subscribe' => -1 ] , ['openid'=>$openId]);
    }
    
    /**
     * 获取用户的openid
     * @param int $uid 
     */
    public function getOpenId( $uid ){
        $data = M($this->_table)->where(['id'=>$uid,'subscribe'=>1])->field('openid')->find();
        return $data['openid'];
    }
    
    /**
     * 获取用户的id
     */
    public function getUserId( $openId ){
        $data = M($this->_table)->where(['openid'=>$openId,'subscribe'=>1])->field('id')->find();
        return $data['id'];
    }

}

