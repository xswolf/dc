<?php
namespace Wx\Controller;

use LaneWeChat\Core\Media;
use LaneWeChat\Core\AdvancedBroadcast;
class IarticlesController extends InitiativeController{
    
    public function index(){
       $this->display();   
    }
    
    //上传图片
    public function uploadImg(){
        //'ybFlQ9kmPTgiCWZT8Mq_1YnKtBziwpbaVDaftpJckPtFzlwROlgXpKCd9Dbl_JRs'
        if(!empty($_FILES)){
            $info = reset( upload() );
            
            $data = Media::upload(realpath( $info['file_save_path'] ), 'image');
            file_put_contents('./wx-test/uploadimg.txt', json_encode($data));
            dump($data);
        }
//        dump(  Media::upload(realpath('./Public/Uploads/2015-09-23/560218d10525f.jpg'),'image' ));
    }
    
    public function download(){
        file_put_contents('./wx-test/down.jpg', Media::download('Hva-LYOON6lXC_MiS8H9OGDSisWZXyAWn3deI0SM7iEL0Uy2mdFHT4yaTabTFiq4'));
    }
    
    
    //新增图文消息
    public function uploadNews(){
        //'pk7-ztaDrb1tKm6mPwKtxJO50386VvsJ6qgDw6isuUypA94v9xj3RdXYUMuqkI4b'
        $articles = [
            [
                'title'         =>  '请戳图',
                'thumb_media_id'=>  'ybFlQ9kmPTgiCWZT8Mq_1YnKtBziwpbaVDaftpJckPtFzlwROlgXpKCd9Dbl_JRs',
                'author'        =>  'gy',
                'digest'        =>  '哈哈哈哈哈哈哈',
                'show_cover_pic'=>  1,
                'content'       =>  '',
                'content_source_url'=>'www.baidu.com'
            ]
        ];
        $info = AdvancedBroadcast::uploadNews($articles);
        dump($info);
    } 
}