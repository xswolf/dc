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
                <li><a href="component">component</a></li>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <h2>popover</h2>
            <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">可消失的弹出框</a>
        </div>
        <div class="col-md-3">
            <h2>modal</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h2>tooltips</h2>
            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>

            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>

            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>

            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
        </div>
        <div class="col-md-3">
            <h2>alert</h2>
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h2>Collapse</h2>
            <div class="panel-group" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                                Collapsible list group
                            </a>
                        </h4>
                    </div>
                    <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="false" style="height: 0px;">
                        <ul class="list-group">
                            <li class="list-group-item">Bootply</li>
                            <li class="list-group-item">One itmus ac facilin</li>
                            <li class="list-group-item">Second eros</li>
                        </ul>
                        <div class="panel-footer">Footer</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">


        </div>

        <div class="col-md-3">

        </div>


        <div class="col-md-3">

        </div>
    </div>
</div>
<div class=""></div>

<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins -->
<link rel="stylesheet" href="/Public/libs/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css"/>
<script src="/Public/libs/plugins/bootstrapvalidator-master/dist/js/bootstrapValidator.min.js"></script>


<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>
</body>
</html>