<?php
namespace Wx\Controller;

use Common\Controller\BaseController;
use Wx\Model\MaterialModel;
use Think\Page;

class MaterialController extends BaseController{

    public function index(){
        $count = MaterialModel::instance()->getCount();
        $page = new Page($count , 1 );
        $data = MaterialModel::instance()->getList([],$page->firstRow.','.$page->listRows);
       
        $this->assign("page",$page->show());
        $this->assign("data",$data);
        $this->display();
    }
    
    public function edit(){
        if(IS_POST){
            $data = I('post.');
            if(empty($data['name'])) $this->ajaxError('请填写名字');
            $rel = MaterialModel::instance()->edit($data);
            if($rel!==false){
                $this->ajaxSuccess('');
            }else{
                $this->ajaxError('保存失败');
            } 
                
        }else{
            $id = I("get.id",'','intval');
            if($id){
                $data = MaterialModel::instance()->getList(['id'=>$id]);
                $data = end($data);
                foreach($data['content'] as $index=>&$val){
                    $val['sort']    =   $index+1;
                }
            }else{
                $data = [];
            }
            $this->assign("data",json_encode($data) );
            $this->display();
        }
    }
    
    public function del(){
        if(IS_POST){
            $id = I('post.id','','intval');
            $data = end(MaterialModel::instance()->getList(['id'=>$id]));
            if(empty($data['key'])){
                $rel = MaterialModel::instance()->del($id);
                if($rel!==false)
                    $this->ajaxSuccess('删除成功');
            }else{
                $this->ajaxError('该素材不能删除');
            }
        }
        $this->ajaxError('删除失败');
    }
    
    public function upload(){
        $data = upload('./Wx/Material/');
        if(is_array($data)){
            $path = 'http://'.$_SERVER['HTTP_HOST'].ltrim($data['file']['file_save_path'],'.');
            $this->ajaxSuccess($path);
        }
        $this->ajaxError('上传失败'.$data);
    }
    
}

