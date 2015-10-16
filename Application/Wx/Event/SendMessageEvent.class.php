<?php
namespace Wx\Event;

use Common\Controller\BaseController;
use LaneWeChat\Core\ResponseInitiative;
use LaneWeChat\Core\AdvancedBroadcast;
use LaneWeChat\Core\AccessToken;
use LaneWeChat\Core\Curl;
use Wx\Model\UserModel;
class SendMessageEvent extends BaseController{
    
    private $request = [];
    private $fromUsername = '';
    
    public function __construct( $request ){
        if(!empty($request)){
            $this->request = $request;
            if(empty($request['tousername']))
                return false;
            $this->fromUsername = $request['fromusername'];
        }
    }
    

    
    //扫描二维码处理
    public  function scanTableQrcode(){
        if(isset($this->request['ticket'])){
            $qrcode = M("wx_qrcode")->where(['ticket'=>$this->request['ticket']])->find();
            //判断是否是扫描的桌号
            if($qrcode['groups']=='table'){
                $table = M("shop_table")->where(['qrcode_id' => $qrcode['id']])->find();
                $mid = UserModel::instance()->getUserId($this->fromUsername);
                if($table){
                    $url = "http://www.qulianchn.com/index?mid={$mid}&time=".time()."&table={$table['id']}";
                    $data[] = ResponseInitiative::newsItem('你已进入'.$table['name'].'桌', '请点击图片开始点餐', 'http://gypc2.nat123.net/public/uploads/2015-09-23/560218c410388.jpg', $url);
                    $result =ResponseInitiative::news($this->fromUsername, $data);
                }
            }else{
                //TODO
                ResponseInitiative::text($this->fromUsername, "感谢你的关注");
            }
        }
    }
}

