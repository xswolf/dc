<?php
namespace Admin\Controller;
use Admin\Model\GoodsCategoryModel;
use Admin\Model\GoodsModel;
use Admin\Model\GoodsTypeModel;
use Admin\Model\ShopTableModel;
use Common\Controller\VerifyController;
use Wx\Event\QrcodeEvent;

class SettingsController extends VerifyController {

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

    // 菜品分类管理
    public function goodsType(){

        $list = GoodsCategoryModel::instance()->lists($this->user->getShopId());
        $this->assign('list' , $list);
        $this->display();
    }

    // 添加修改菜品分类
    public function saveGoodsType(){
        if (I('id')){
            $data = GoodsCategoryModel::instance()->findById(I('id'));
            $this->assign('data' , $data);
        }
        if($_POST){
            if (I("post.id")){ // 编辑

                GoodsCategoryModel::instance()->edit($_POST);
            }else{ // 添加
                $_POST['shop_id'] = $this->user->getShopId();
                GoodsCategoryModel::instance()->insert($_POST) ;
            }
            $this->_success('添加成功' , U('goodsType'));

        }

        $this->display();
    }

    // 桌号管理
    public function table(){
        $list = ShopTableModel::instance()->lists($this->user->getShopId());
        $this->assign('list' , $list);
        $this->display();
    }

    // 添加修改桌号
    public function saveTable(){
        if (I('id')){
            $data = ShopTableModel::instance()->findById(I('id'));
            $this->assign('data' , $data);
        }
        if($_POST){
            if (I("post.id")){ // 编辑

                ShopTableModel::instance()->edit($_POST);
            }else{ // 添加

                $qrCode = new QrcodeEvent();
                $data = $qrCode->create($this->user->getShopId());

                if ($data){
                    $_POST['qrcode_id'] = $data['qrcode_id'];
                    $_POST['url'] = $data['url'];
                    $_POST['shop_id'] = $this->user->getShopId();
                    ShopTableModel::instance()->insert($_POST);
                }

            }
            $this->_success('添加成功' , U('table'));

        }

        $this->display();
    }

    // 菜品管理
    public function goods(){
        $list = GoodsModel::instance()->lists($this->user->getShopId());
        $typeList = GoodsCategoryModel::instance()->lists($this->user->getShopId());
        $this->assign('list' , $list);

        $this->assign('typeList' , $typeList); //菜品分类
        $this->display();
    }

    // 设置菜品
    public function saveGoods(){
        if (I('id')){
            $data = GoodsModel::instance()->findById(I('id'));
            $this->assign('data' , $data);
        }
        if($_POST){
            if (I("post.id")){ // 编辑

                GoodsModel::instance()->edit($_POST);
            }else{ // 添加
                $_POST['shop_id'] = $this->user->getShopId();
                GoodsModel::instance()->insert($_POST);
            }
            $this->_success('添加成功' , U('goods'));

        }

        $list = GoodsCategoryModel::instance()->lists($this->user->getShopId());
        $this->assign('list' , $list); //菜品分类
        $this->display();
    }

    public function del(){
        $id = I('id');
        $table = I('table');
        if (M($table)->where(['id'=>$id])->delete()){
            $this->ajaxSuccess('删除成功');
        }else{
            $this->ajaxError('删除失败');
        }
    }


}