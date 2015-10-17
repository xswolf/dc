<?php
namespace Admin\Controller;
use Common\Controller\VerifyController;

use Admin\Model\OrderModel;
class OrderController extends VerifyController {
    /**
     * @var int 平台ID
     */
    protected $platform_id;

    /**
     * @var int 店铺ID
     */
    protected $shop_id;

    public function _before_order() {
        $this->shop_id = $this->user->getShopId();
    }

    public function index(){
        $this->display();
    }

    /**
     * 商家管理平台 -> 当前订单
     */
    public function order() {
        $this->display();
    }

    public function getOrder() {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $request = I('get.sn');
        $data = OrderModel::instance()->orderList($this->user->getShopId(), ['status' => 2], $request);
        if(is_array($data)) {
            foreach($data as &$list) {
                $list['orderTime'] = $this->time_tran($list['created_at']);
                $list['orderGoodsList'] = OrderModel::instance()->orderGoodsList($list['id']);
            }
        }
        echo "data: ".json_encode($data)."\n\n";
        flush();
    }

    /**
     * 确认订单
     */
    public function sureOrder() {
        $id = intval(I('post.id'));
        if(!empty($id) && is_numeric($id)) {
            $flag = OrderModel::instance()->sureOrder($this->user->getShopId(),$id);
            if($flag) {
                $orderGoodsData = OrderModel::instance()->orderGoodsList($id);
                $orderData = OrderModel::instance()->getOrderById($id);
                $this->ajaxSuccess(['orderData'=>$orderData , 'orderGoodsData'=>$orderGoodsData]);
            }
        }
        $this->ajaxError([]);
    }

    /**
     * 历史订单
     */
    public function historyOrder(){
        $request = I('post.sn');
        $start = I('post.start');
        $end = I('post.end');
        $s_time = !empty($start) ? strtotime($start) : NULL;
        $e_time = !empty($end) ? strtotime($end) : NULL;
        $w['status'] = ['eq',2];
        if(!is_null($s_time) && !is_null($e_time)) {
            $e_time = $e_time + 24*3600;
            $w['created_at'] = ['between', "{$s_time}, {$e_time}"];
        } else if(!is_null($s_time)) {
            $w['created_at'] = ['egt',$s_time];
        } else if(!is_null($e_time)) {
            $w['created_at'] = ['elt',$e_time + 24*3600];
        }
        $data = OrderModel::instance()->orderList($this->user->getShopId(), $w, $request);
        if(is_array($data)) {
            foreach($data as &$list) {
                $list['orderTime'] = $this->time_tran($list['created_at']);
                $list['orderGoodsList'] = OrderModel::instance()->orderGoodsList($list['id']);
            }
        }

        $this->assign('sn', $request);
        $this->assign('start', $start);
        $this->assign('end', $end);
        $this->assign('data', $data);
        $this->display();
    }

    private function time_tran($the_time) {
        $t = time()-$the_time;
        $f = [
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        ];
        foreach ($f as $k=>$v) {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

}