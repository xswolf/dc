<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'     => 'Site', //默认模块
    'URL_MODEL'          => '2',    //URL模式
    'SESSION_AUTO_START' => true,   //是否开启session
    'LOAD_EXT_CONFIG'    => 'db',      //加载扩展配置文件
    'MODULE_DENY_LIST'   => ['Common', 'Runtime'],
    'MODULE_ALLOW_LIST'  => ['Home', 'Admin', 'Site','Wx'],
    'SHOW_PAGE_TRACE'=>1,
    'DEFAULT_MODULE'     => 'Site',
);