<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/11
 * Time: 9:15
 */

/**
 * 日期加减
 * @param $currDate
 * @param $n
 * @param string $type
 * @return string
 */
function dateAdd($currDate, $n, $type = 'd')
{
    switch ($type) {
        case "y":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n year"));
            break;
        case "m":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n month"));
            break;
        case "w":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n week"));
            break;
        case "d":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n day"));
            break;
        case "h":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n hour"));
            break;
        case "n":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n minute"));
            break;
        case "s":
            $val = date("Y-m-d H:i:s", strtotime($currDate . " +$n second"));
            break;
    }

    return $val;
}

/**
 * 获取微信上的用户信息
 */
function wx_get_user_info( $openId ){
    return \LaneWeChat\Core\UserManage::getUserInfo($openId);
}

/**
 * 获取微信上的用户用户列表
 */
function wx_get_user_list( $next_openId ){
    return \LaneWeChat\Core\UserManage::getFansList($next_openId);
}

/*
 * 上传
 */
function upload( $path='' , $type=[]){
    $upload = new \Think\Upload();                                                          // 实例化上传类
    $upload->maxSize   =     3145728 ;                                                      // 设置附件上传大小
    $upload->exts      =     empty($type) ? ['jpg', 'gif', 'png', 'jpeg'] : $type;          // 设置附件上传类型
    $upload->rootPath  =     './Public/';
    $upload->savePath  =     empty($path) ? './Uploads/' : $path ;                          // 设置附件上传目录
    if(!file_exists($upload->rootPath.$upload->savePath)){
        mkdir($upload->rootPath.$upload->savePath , 0777 , true);
    }
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        return $upload->getError();
    }else{// 上传成功
        foreach($info as &$val){
            $val['file_save_path'] = $upload->rootPath.ltrim($val['savepath'],'./').$val['savename'];
        }
        return $info;
    }
}