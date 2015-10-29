<?php
namespace Wx\Event;

use Common\Controller\BaseController;
use LaneWeChat\Core\ResponseInitiative;
use LaneWeChat\Core\AdvancedBroadcast;
use LaneWeChat\Core\AccessToken;
use LaneWeChat\Core\Curl;
use Wx\Model\UserModel;
use LaneWeChat\Core\ResponsePassive;
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
    

    
    /**
     * 扫描二维码处理
     */
    public  function scanTableQrcode(){
        if(isset($this->request['ticket'])){
            $qrcode = M("wx_qrcode")->where(['ticket'=>$this->request['ticket']])->find();
            //判断是否是扫描的桌号
            if($qrcode['groups']=='table'){
                $table = M("shop_table")->where(['qrcode_id' => $qrcode['id']])->find();
                $mid = UserModel::instance()->getUserId($this->fromUsername);
                if($table){
                    $url = "http://{$table['shop_id']}.qulianchn.com/index?mid={$mid}&time=".time()."&table={$table['id']}";
                    $data[] = ResponseInitiative::newsItem('你已进入'.$table['name'].'桌', '请点击图片开始点餐', 'http://gypc2.nat123.net/Public/Wx/img/diancan.jpg', $url);
                    $result =ResponseInitiative::news($this->fromUsername, $data);
                }
            }else{
                //TODO
                ResponseInitiative::text($this->fromUsername, "感谢你的关注");
            }
        }
    }
    
    /**
     * 点击菜单处理
     */
    public function clickMenu(){
        $data = M("wx_menu")->where(['id'=>$this->request['eventkey']])->field("value")->find();
        ResponseInitiative::text($this->formUsername, $data['value']);
    }
    
}

