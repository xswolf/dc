<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/21
 * Time: 9:11
 */

namespace Admin\Controller;


use Admin\Model\CashModel;
use Common\Controller\VerifyController;

class DataAnalysisController extends VerifyController{

    /**
     * 营业数据
     */
    public function businessData($startTime = '' , $endTime = ''){

        $s_time = date_to_int($startTime);
        $e_time = date_to_int($endTime);

        $list = CashModel::instance()->lists($this->user->getShopId() , '' , $s_time , $e_time);

        $this->assign('startTime' , $startTime);
        $this->assign('endTime' , $endTime);
        $this->assign('list' , $list);
        $this->display();
    }
}