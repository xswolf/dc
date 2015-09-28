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
                        <li><a href="#">流水明细</a></li>
                        <li><a href="#">营业数据</a></li>
                    </ul>
                </li>
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
<div class="container">
    <div class="wpBox">
        <div class="bd">


            <form class="form-horizontal j-validator" method="post">
                <fieldset>
                    <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
                    <!-- Form Name -->
                    <legend>设置菜品分类</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="">菜品名称</label>
                        <div class="col-md-4">
                            <input name="name" type="text" value="<?php echo ($data['name']); ?>" placeholder="菜品名称" class="form-control input-md" data-bv-notempty data-bv-notempty-message="">
                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput1">原价</label>
                        <div class="col-md-4">
                            <input id="textinput1" name="native_price" value="<?php echo ($data['native_price']); ?>" type="number" placeholder="原价" class="form-control input-md">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput2">现价</label>
                        <div class="col-md-4">
                            <input id="textinput2" name="price" value="<?php echo ($data['price']); ?>" type="number" placeholder="现价" class="form-control input-md">
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="selectbasic">所属菜单</label>
                        <div class="col-md-4">
                            <select id="selectbasic" name="goods_type_id" class="form-control">
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["id"]) == $data["goods_type_id"]): ?><option value="<?php echo ($vo["id"]); ?>" selected><?php echo ($vo["name"]); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">图片</label>
                        <div class="col-md-4">
                            <input id="filebutton" class="input-file" type="file" onchange="">
                            <input id="hide-put" name="pic1" type="hidden" value="<?php echo ($data['pic1']); ?>">
                            <img id="imgShow" src="<?php echo ($data['pic1']); ?>" alt="菜品图片">
                            <span class="help-block">（建议图片尺寸：360*360px）</span>
                        </div>

                    </div>



                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="radios">状态</label>
                        <div class="col-md-4">
                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="status" id="radios-0" value="1" checked="checked">
                                启用
                            </label>
                            <label class="radio-inline" for="radios-1">
                                <input type="radio" name="status" id="radios-1" value="0">
                                禁用
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button class="btn btn-success " type="submit">提　交</button>
                        </div>
                    </div>

                </fieldset>
            </form>



        </div>
    </div>
</div>
<script src="/Public/libs/upload/ajaxupload.js"></script>
<script>
    window.onload = function() {
        init();  //初始化
    }

    //初始化
    function init() {
        //初始化图片上传
        var btnImg = document.getElementById("filebutton");
        var img = document.getElementById("imgShow");
        var hidImgName = document.getElementById("hide-put");
        g_AjxUploadImg(btnImg, img, hidImgName);
    }

    function g_AjxUploadImg(btn, img, hidPut) {
        var button = btn, interval;
        new AjaxUpload(button, {
            action: '/admin/upload/up',
            data: {},
            name: 'upFile',
            responseType:'json',
            onSubmit: function(file, ext) {
                if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {
                    alert("您上传的图片格式不对，请重新选择！");
                    return false;
                }
            },
            onComplete: function(file, response) {
                flagValue = response;
                if (flagValue == "1") {
                    alert("您上传的图片格式不对，请重新选择！");
                }
                else if (flagValue == "2") {
                    alert("您上传的图片大于200K，请重新选择！");
                }
                else if (flagValue == "3") {
                    alert("图片上传失败！");
                }
                else {
                    var g_AjxTempDir = "/Uploads/";
                    hidPut.value = g_AjxTempDir + response.data.upFile.savepath+response.data.upFile.savename;
                    console.log(response.data.upFile);
                    img.src = g_AjxTempDir + response.data.upFile.savepath+response.data.upFile.savename;
                }
            }
        });
    }
</script>
<div class=""></div>

<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins -->
<link rel="stylesheet" href="/Public/libs/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css"/>
<script src="/Public/libs/plugins/bootstrapvalidator-master/dist/js/bootstrapValidator.min.js"></script>

<link rel="stylesheet" href="/Public/libs/plugins/toastr/toastr.min.css"/>
<script src="/Public/libs/plugins/toastr/toastr.min.js"></script>


<link rel="stylesheet" href="/Public/libs/plugins/datatables/dataTables.css"/>
<script src="/Public/libs/plugins/datatables/jquery.dataTables.js"></script>
<script src="/Public/libs/plugins/datatables/dataTables.bootstrap.js"></script>


<link rel="stylesheet" href="/Public/libs/plugins/bootstrap-datatimepicker/css/bootstrap-datetimepicker.min.css"/>
<script src="/Public/libs/plugins/bootstrap-datatimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script charset="UTF-8" src="/Public/libs/plugins/bootstrap-datatimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>


<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>

<!-- 公共组件测试 -->
<script src="/Public/js/test.js"></script>



<!--  -->
<script src="/Public/js/app.js"></script>
</body>
</html>