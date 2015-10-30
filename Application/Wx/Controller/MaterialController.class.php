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
            $this->assign("data" , json_encode(end($data)) );
        }
        $this->display();
    }
}

