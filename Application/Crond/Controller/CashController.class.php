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
        $sql = "INSERT INTO w_cash(shop_id,create_date,cash_money,STATUS)
                SELECT shop_id , FROM_UNIXTIME(created_at,'%Y%m%d') created_date,  SUM(price),0 FROM  w_order WHERE STATUS=2 AND id<=8 GROUP BY shop_id ,created_date";
        return M('')->query($sql);
    }

}