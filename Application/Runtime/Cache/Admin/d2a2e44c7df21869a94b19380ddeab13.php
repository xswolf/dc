<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>登录</title>
    <!-- Loading Bootstrap -->
    <link href="/Public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->

    <!-- customer -->
    <link href="/Public/css/main.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
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
                <li><a href="#">当前订单<span class="sr-only">(current)</span></a></li>
                <li><a href="common">历史订单</a></li>
                <li id="fat-menu" class="dropdown active">
                    <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        系统设置
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="drop3">
                        <li class="active"><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <li><a href="common">common</a></li>
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
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>登录</title>
    <!-- Loading Bootstrap -->
    <link href="/Public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- customer -->
    <link href="/Public/css/main.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">
    <style>
        body {
            background-color: #f0f0f0;
        }

        .form-horizontal .form-group {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body>



<div class="registerBox">
    <div class="hd">
        <h1>有餐</h1>
    </div>
    <form class="form-horizontal j-validator" method="post">
        <div class="form-group">
            <input type="text" name="accountName" placeholder="账户名" class="form-control" data-bv-notempty data-bv-notempty-message="帐号名不能为空!">
        </div>
        <div class="form-group">
            <input type="text" name="shopName" placeholder="店铺名" class="form-control" data-bv-notempty data-bv-notempty-message="店铺名不能为空!">
        </div>
        <div class="form-group">
            <input type="text" name="telNum" placeholder="手机号" class="form-control" data-bv-notempty data-bv-notempty-message="手机号不能为空!">
        </div>
        <div class="form-group">
            <input type="password" name="pass1" placeholder="密码" class="form-control" data-bv-notempty data-bv-notempty-message="密码不能为空!" data-bv-identical="true" data-bv-identical-field="pass2" data-bv-identical-message="两次密码不一致!">
        </div>
        <div class="form-group">
            <input type="password" name="pass2" placeholder="重复密码" class="form-control" data-bv-notempty data-bv-notempty-message="密码不能为空!" data-bv-identical="true" data-bv-identical-field="pass1" data-bv-identical-message="两次密码不一致!">
        </div>
        <button type="submit" class="btn btn-success btn-block">立即注册</button>
    </form>
</div>


<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins -->
<link rel="stylesheet" href="/Public/libs/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css"/>
<script src="/Public/libs/plugins/bootstrapvalidator-master/dist/js/bootstrapValidator.min.js"></script>


<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>

<script>
    $(function() {

        // 添加验证字段的规则
        window.app.form[0].addField('accountName', {
            validators: {
                notEmpty: {
                    message: '账户名不能为空!'
                },
                stringLength: {
                    min: 4,
                    max: 12,
                    message: '账户名为4~12位'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: '账户名只能包含字母，数字，下划线'
                }
//                remote: {
//                    url: 'remote.php',
//                    message: '账户名已经存在!'
//                }
            }
        });
        window.app.form[0].addField('telNum', {
            validators: {
                regexp: {
                    regexp: /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/,
                    message: '请输入正确的手机号'
                }
            }
        });

    })
</script>


</body>
</html>
<div class=""></div>


<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>


<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>
</body>
</html>