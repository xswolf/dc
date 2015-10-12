<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>商家列表</title>
    <!-- Loading Bootstrap -->
    <link href="/Public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->

    <!-- customer -->
    <link href="/Public/css/main.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <link href="/Public/libs/bootstrap/css/bootstrap-switch.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">商家管理平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div class="panel panel-primary">
    <div class="panel-heading">编辑商家</div>
    <div class="panel-body">
        <div class="registerBox">
            <div class="hd">
                <h1>有餐</h1>
            </div>
            <form class="form-horizontal j-validator" action="edit" method="post">
                <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">

                <div class="form-group">
                    账户名： <input type="text" name="name" value="<?php echo ($data['name']); ?>" placeholder="账户名" class="form-control"
                                data-bv-notempty data-bv-notempty-message="帐号名不能为空!">
                </div>
                <div class="form-group">
                    店铺名：
                    <input type="text" name="shopName" value="<?php echo ($data['shopName']); ?>" placeholder="店铺名"
                           class="form-control" data-bv-notempty data-bv-notempty-message="店铺名不能为空!">
                </div>
                <div class="form-group">
                    手机号：
                    <input type="text" name="tel" value="<?php echo ($data['tel']); ?>" placeholder="手机号" class="form-control"
                           data-bv-notempty data-bv-notempty-message="手机号不能为空!">
                </div>

                <div class="form-group">
                    <input type="password" name="password" value="" placeholder="密码" class="form-control"
                           data-bv-notempty-message="密码不能为空!" data-bv-identical="true"
                           data-bv-identical-field="rePassword" data-bv-identical-message="两次密码不一致!">
                </div>
                <div class="form-group">
                    <input type="password" name="rePassword" value="" placeholder="重复密码" class="form-control"
                           data-bv-notempty-message="密码不能为空!" data-bv-identical="true"
                           data-bv-identical-field="password" data-bv-identical-message="两次密码不一致!">
                </div>

                <button type="submit" class="btn btn-success btn-block">保存</button>
            </form>
        </div>
    </div>
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
    $(function () {

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