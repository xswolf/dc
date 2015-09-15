<?php
namespace Admin\Controller;
use Admin\Model\GoodsCategoryModel;
use Common\Controller\VerifyController;

/**
 * Class GoodsCategoryController
 * @package Admin\Controller\
 * TODO 档口分类预留
 */
class GoodsCategoryController extends VerifyController {

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

}