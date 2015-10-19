<?php
namespace Wx\Controller;

use Common\Controller\BaseController;
use Wx\Model\MenuModel;

/**
 * 微信自定义菜单管理
 * @author guoguo
 *
 */
class MenuController extends BaseController{
    
    public function index(){
        
        $list = MenuModel::instance()->getMenuList();
        $this->display();
    }
    
    /**
     * 添加菜单
     */
    public function add(){
        if(IS_AJAX){
            empty($_POST['name']) && $this->ajaxError("请填写菜单名");
            empty($_POST['type']) && $this->ajaxError("菜单类型错误");
            $data = [
                'name'      => $_POST['name'],
                'type'      => $_POST['type'],
                'pid'       => empty($_POST['pid']) ? 0 : intval($_POST['pid']),
                'value'     => "",
                'status'    => 1,
                'sort'      => 0,
                'created_at'=> time(),
            ];
            if($data['type'] == "view"){
                empty($_POST['url']) && $this->ajaxError('请填写url');
                $data['value'] = $_POST['url'];
            }elseif($data['type'] == "media_id"){
                empty($_POST['material']) && $this->ajaxError('请选择素材');
                $data['value'] = $_POST['material'];
            }
            $num = MenuModel::instance()->getMenuSum($data['pid']);
            if($data['pid'] && $num >= 5){
                $this->ajaxError("二级菜单已达到数量上限");
            }elseif ($data['pid']==0 && $num >= 3){
                $this->ajaxError('一级菜单已达数量上限');
            }
            
            $rel = MenuModel::instance()->add($data);
            if($rel)
                $this->ajaxSuccess("");
        }
        $this->ajaxError("操作失败");
    }
    
}
