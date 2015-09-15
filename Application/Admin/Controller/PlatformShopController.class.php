<?php
namespace Admin\Controller;
use Admin\Model\PlatformShopModel;
use Common\Controller\VerifyController;

class PlatformShopController extends VerifyController

{
    public function index()
    {

    }

    public function save(){

        if($_POST){

            if (I("post.id")){ // 编辑

                PlatformShopModel::instance()->edit($_POST);
            }else{ // 添加

                PlatformShopModel::instance()->insert($_POST);
            }
        }

        $this->display();
    }

}