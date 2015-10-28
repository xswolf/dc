<?php
namespace Wx\Controller;

use Common\Controller\BaseController;
use Wx\Model\MenuModel;
use LaneWeChat\Core\Menu;

/**
 * 微信自定义菜单管理
 * @author guoguo
 *
 */
class MenuController extends BaseController{
    
    public function index(){
        $list = MenuModel::instance()->getMenuList();
        
        $this->assign( "list" , $list );
        $this->display();
    }
    
    /**
     * 添加|编辑 菜单
     */
    public function edit(){
        if(IS_AJAX){
            empty($_POST['name']) && $this->ajaxError("请填写菜单名");
            empty($_POST['type']) && $this->ajaxError("菜单类型错误");
            $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
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
            if(empty($id)){
                if($data['pid'] && $num >= 5){
                    $this->ajaxError("二级菜单已达到数量上限");
                }elseif ($data['pid']==0 && $num >= 3){
                    $this->ajaxError('一级菜单已达数量上限');
                }
                $rel = MenuModel::instance()->add($data);
            }else{
                unset($data['sort']);
                unset($data['created_at']);
                $rel = MenuModel::instance()->where(['id'=>$id])->save($data);
            }
            
            if($rel!==false)
                $this->ajaxSuccess($rel);
        }
        $this->ajaxError("操作失败");
    }
    
    /**
     * 排序
     */
    public function sort(){
        if(IS_AJAX){
            $id = I('post.id' , 'intval');
            $level = I('post.level' , 'intval');
            if( $id && in_array($level, [1,2]) ){
                $rel = MenuModel::instance()->sort($id, $level);
                if($rel)
                    $this->ajaxSuccess($rel);
            }
        }
        $this->ajaxError('操作失败');
    }   
    
    /**
     *删除
     */
    public function del(){
        if(IS_AJAX){
            $id = I('post.id','intval');
            if($id){
                $rel = MenuModel::instance()->del($id);
                if($rel !== false)
                    $this->ajaxSuccess('');
            }
        }
        $this->ajaxError('删除失败');
    }
    
    /**
     * 同步到微信
     */
    public function sync_wx(){
        $list = MenuModel::instance()->getMenuList();
        if(count($list)){
            $data = $this->menulist($list);
            $rel = Menu::setMenu($data);
            if($rel===true){
                $this->ajaxSuccess('同步成功');
            }else{
                $this->ajaxError($rel['errcode'].$rel['errmsg']);
            }
        }
        $this->ajaxError('操作失败');
        
    }
    
    public function get_wx_menu(){
        $data = Menu::getMenu();
        dump($data);
    }
    
    private function menulist( $data ){
        $rel = [];
        foreach($data as $val){
            $rel[] = [
                'id'    =>  $val['id'],
                'pid'   =>  $val['pid'],
                'name'  =>  $val['name'],
                'type'  =>  $val['type'],
                'code'  =>  $val['type']=='click' ? $val['id'] : $val['value'],
            ];
            if(!empty($val['child'])){
                $arr = $this->menulist($val['child']);
                $rel = array_merge($rel , $arr);
            }
        }
        return $rel;
    }
    
    /**
     * 清除微信菜单
     */
    public function caear_menu(){
        if(IS_AJAX){
            $rel = Menu::delMenu();
            if($rel['errcode']==0){
                $this->ajaxSuccess('');
            }
        }
        $this->ajaxError('删除失败');
    }
    
}
