<?php
namespace Wx\Controller;

use Common\Controller\BaseController;

/**
 * 微信自定义菜单管理
 * @author guoguo
 *
 */
class MenuController extends BaseController{
    
    public function index(){
        
        $this->display();
    }
    
    public function add(){
        
        if(IS_AJAX){
            empty($_POST['name']) && $this->ajaxError("请填写菜单名");
            empty($_POST['type']) && !intval($_POST['type']) && $this->ajaxError("菜单类型错误");
            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
            ];
            if($data['type']==2){
                empty($_POST['url']) && $this->ajaxError('请填写url');
                $data['value'] = $_POST['url'];
            }
            if($data['type']==3){
                empty($_POST['material']) && $this->ajaxError('请选择素材');
                $data['value'] = $_POST['material'];
            }
            
        }
    }
    
}
