<?php
namespace Wx\Controller;

use Common\Controller\BaseController;
use Wx\Model\MaterialModel;

class MaterialController extends BaseController{

    public function index(){
        $data = MaterialModel::instance()->getList();
        
        $this->assign("data",$data);
        $this->display();
    }
    
    public function edit(){
        $id = I("get.id",'intval');
        if($id){
            $data = MaterialModel::instance()->getList(['id'=>$id]);
            $data = end($data);
            foreach($data['content'] as $index=>&$val){
                $val['sort']    =   $index+1;
            }
            $this->assign("data",json_encode($data) );
        }
        $this->display();
    }
    
}

