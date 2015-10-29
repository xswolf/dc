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
        
        $this->display();
    }
}

