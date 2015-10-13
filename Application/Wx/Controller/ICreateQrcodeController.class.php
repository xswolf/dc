<?php
namespace Wx\Controller;

use LaneWeChat\Core\Popularize;
use Wx\Model\QrcodeModel;
/**
 * @author guoguo
 * 创建二维码
 */
class ICreateQrcodeController extends InitiativeController{
    
    
    public function create( $type = 1 , $expire=604800 , $sene_str=''){
       $sene_id = QrcodeModel::instance()->getSceneId($type);
       $data = Popularize::createTicket($type, 604800, $sene_id);
       if(empty($data['errcode'])){
           $qrcode_path = "./Public/Wx/Qrcode/".date('Ymd').'/';
           if( !file_exists($qrcode_path) ){
               mkdir( $qrcode_path , 0777 , true);
           }
           $qrcode_url = $qrcode_path.md5( microtime() ).'.jpg';
           Popularize::getQrcode($data['ticket'] , $qrcode_url);
           
           $arr = [
               'ticket'     =>  $data['ticket'],
               'type'       =>  $type,
               'expire'     =>  $expire,
               'url'        =>  ltrim( $qrcode_url , '.' ),
               'shop_id'    =>  0,
               'groups'      =>  'table',
               'status'     =>  1,
               'created_at' =>  NOW_TIME,
           ];
           $qrcode_id = QrcodeModel::instance()->addQrcode($arr);
           if($qrcode_id)
               return $qrcode_id;
       }
       return false;
    }
    
    
}

