<?php
namespace Admin\Controller;
use Common\Controller\VerifyController;
class GoodsTypeController extends VerifyController {

    public function index(){

    }

    public function save(){
        if($_POST){

            if (I("post.id")){ // 编辑

                GoodsCategoryModel::instance()->edit($_POST);
            }else{ // 添加

                GoodsCategoryModel::instance()->insert($_POST);
            }
        }

        $this->display();
    }

    public function del(){

    }

}