<?php
namespace Wx\Controller;

use LaneWeChat\Core\ResponseInitiative;
use LaneWeChat\Core\AdvancedBroadcast;
use LaneWeChat\Core\AccessToken;
use LaneWeChat\Core\Curl;
class ISendMessageController extends InitiativeController{
    
    private $request = [];
    private $fromUsername = '';
    
    public function __construct( $request ){
        $this->request = $request;
        if(empty($request['tousername']))
            return false;
        $this->fromUsername = $request['fromusername'];
    }
    
    public function sendImg(){
        dump(ResponseInitiative::image($this->toUsername, 'hkkwppHNtBOK7F9LEe5vKhkSdnoRBOEAEWsmopeuo6pTuEGSzZgMkP82QgOClmPo'));
    }
    
    public function newsItem(){
        dump(AdvancedBroadcast::previewImageByGroup($this->toUsername, 'pk7-ztaDrb1tKm6mPwKtxJO50386VvsJ6qgDw6isuUypA94v9xj3RdXYUMuqkI4b'));   
    }
    
    public function getmedia(){
        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.AccessToken::getAccessToken();
        dump(Curl::callWebServer($url , json_encode(['media_id'=>'_pixo29je0ZXWCbJwLC4jfPdN2hi7MzunQW67Fa2Ad3SOy8IitAD_X77kEANn2kD']) , 'POST'));
    }
    
    
    public function sendItem(){
        $data[] = ResponseInitiative::newsItem('请点击图片开始点餐', '请点击图片开始点餐', 'http://gypc2.nat123.net/public/uploads/2015-09-23/560218c410388.jpg', 'http://www.baidu.com');
        ResponseInitiative::news($this->toUsername, $data);
    }
    
    
    //扫描桌号二维码处理
    public  function scanTableQrcode(){
    	if(isset($this->request['ticket'])){
    		$qrcode = M("wx_qrcode")->where(['ticket'=>$this->request['ticket']])->find();
    		if($qrcode['groups']=='table'){
    			$table = M("shop_table")->where(['qrcode_id' => $qrcode['id']])->find();
    			if($table){
    				$data[] = ResponseInitiative::newsItem('你已进入'.$table['name'].'桌', '请点击图片开始点餐', 'http://gypc2.nat123.net/public/uploads/2015-09-23/560218c410388.jpg', 'http://www.baidu.com');
    				ResponseInitiative::news($this->fromUsername, $data);
    			}
    		}
    	}
    }

}