<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo U('Index/cashList');?>">提现管理<span class="sr-only">(current)</span></a></li>

            </ul>

        </div><!-- /.navbar-collapse -->

    </div>
    <!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <h2>提现列表</h2>

    <div class="wpBox">
        <div class="hd">
            <div class="text-right"><a class="btn btn-primary" href="<?php echo U('Index/cashList1');?>">已打款列表</a></div>
        </div>
        <div class="bd">
            <table class="table table-hover table-bordered j-dataTables">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>商家ID</th>
                    <th>店铺名称</th>
                    <th>申请金额</th>
                    <th>申请日期</th>
                    <th class="col-md-3">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["shop_id"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>

                        <td><?php echo ($vo["cash_money"]); ?></td>
                        <td>
                            <?php echo (date("Y-m-d" , $vo["created_at"])); ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="<?php echo U('saveGoods');?>?id=<?php echo ($vo["id"]); ?>">确认付款</a>

                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="/Public/libs/jquery/jquery.1.11.3.min.js"></script>
<script src="/Public/libs/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins -->
<link rel="stylesheet" href="/Public/libs/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css"/>
<script src="/Public/libs/plugins/bootstrapvalidator-master/dist/js/bootstrapValidator.min.js"></script>

<link rel="stylesheet" href="/Public/libs/plugins/toastr/toastr.min.css"/>
<script src="/Public/libs/plugins/toastr/toastr.min.js"></script>

<!-- 公共组件 -->
<script src="/Public/js/common.js"></script>

<!-- 公共组件测试 -->
<script src="/Public/js/test.js"></script>

<script src="/Public/libs/bootstrap/js/bootstrap-switch.min.js"></script>

<!--  -->
<script src="/Public/js/app.js"></script>


<script>
    $(function(){
        $("input[type=checkbox]").bootstrapSwitch();

        $(".switch").on('switchChange.bootstrapSwitch', function (e, data) {
            var status = $(this).children().children().children("input").bootstrapSwitch("state");
            var id = $(this).data('id');
            status = status == true ? 1 : 0;
            $.ajax({
                'type':'post',
                'url':'/admin/index/setShopStatus',
                'data':{'status':status,'id':id},
                "success":function(msg){
                    if (msg.status == 1){
//                        alert('修改成功');
                    }
                }
            });
        });


    })
</script>



</body>
</html>