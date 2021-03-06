<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>商家管理平台</title>
    <!-- Loading Bootstrap -->
    <link href="/Public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->

    <!-- customer -->
    <link href="/Public/css/main.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">商家管理平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/admin/order/order">当前订单<span class="sr-only">(current)</span></a></li>
                <li><a href="/admin/order/historyOrder">历史订单</a></li>
                <li id="fat-menu" class="dropdown active">
                    <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        系统设置
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="drop3">
                        <li><a href="/admin/settings/table">桌号管理</a></li>
                        <li><a href="<?php echo U('settings/goodsType');?>">菜单管理</a></li>
                        <li><a href="<?php echo U('settings/goods');?>">菜品管理</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo U('Order/historyOrder');?>">流水明细</a></li>
                        <li><a href="#">营业数据</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo U('cash/index');?>">提现申请</a></li>
                <li><a href="<?php echo U('cash/cashList');?>">提现流水</a></li>
                <li><a href="/admin/user/component">component</a></li>
                <li><a href="/admin/user/common">common</a></li>
            </ul>

            <!--<ul class="nav navbar-nav navbar-right">-->
                <!--<li class="dropdown">-->
                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">系统设置 <span class="caret"></span></a>-->
                    <!--<ul class="dropdown-menu">-->
                        <!--<li><a href="#">Action</a></li>-->
                        <!--<li><a href="#">Another action</a></li>-->
                        <!--<li><a href="#">Something else here</a></li>-->
                        <!--<li role="separator" class="divider"></li>-->
                        <!--<li><a href="#">Separated link</a></li>-->
                    <!--</ul>-->
                <!--</li>-->
            <!--</ul>-->
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
</html>
<div class=""></div>

<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins -->
<link rel="stylesheet" href="/Public/libs/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css"/>
<script src="/Public/libs/plugins/bootstrapvalidator-master/dist/js/bootstrapValidator.min.js"></script>

<link rel="stylesheet" href="/Public/libs/plugins/toastr/toastr.min.css"/>
<script src="/Public/libs/plugins/toastr/toastr.min.js"></script>


<link rel="stylesheet" href="/Public/libs/plugins/datatables/css/dataTables.bootstrap.css"/>
<script src="/Public/libs/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/Public/libs/plugins/datatables/js/dataTables.bootstrap.js"></script>


<link rel="stylesheet" href="/Public/libs/plugins/bootstrap-datatimepicker/css/bootstrap-datetimepicker.min.css"/>
<script src="/Public/libs/plugins/bootstrap-datatimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script charset="UTF-8" src="/Public/libs/plugins/bootstrap-datatimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>


<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>

<!-- 公共组件测试 -->
<script src="/Public/js/test.js"></script>



<!--  -->
<script src="/Public/js/app.js"></script>

<script src="/Public/js/dataTables.js"></script>
</body>
</html>