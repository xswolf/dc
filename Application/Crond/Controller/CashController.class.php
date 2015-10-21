<?php
namespace Crond\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/15
 * Time: 9:17
 */

class CashController extends \Think\Controller{

    public function cash(){
        $date = date('Ymd',strtotime('-1 day',time()));
        $sql = "INSERT INTO w_cash(shop_id,create_date,cash_money,orderCount,STATUS)
                SELECT shop_id , FROM_UNIXTIME(created_at,'%Y%m%d') created_date,  SUM(price) , COUNT(*) , 0 FROM  w_order WHERE STATUS=3 AND FROM_UNIXTIME(created_at,'%Y%m%d') = {$date} GROUP BY shop_id ,created_date";

        return M('')->query($sql);
    }

}