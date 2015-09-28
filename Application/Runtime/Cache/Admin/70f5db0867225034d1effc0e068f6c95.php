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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>WEB打印小票样例</title>
    <!-- 控件跨浏览器调用类库-->
    <script language="javascript" src="/Public/Lodop6.198/LodopFuncs.js"></script>
    <!-- 调用LODOP控件代码-->
    <object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0>
        <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0 pluginspage="install_lodop.exe"></embed>
    </object>
</head>
<body>
<input type="button" value="打印预览" onclick="printPreview()" />
<!-- 控制打印按钮,自动打印可以直接执行printOrder-->
<input type="button" value="直接打印" onclick="printOrder()" />
<script language="javascript" type="text/javascript">
    var LODOP; //声明为全局变量
    var hPos=10,//小票上边距
            pageWidth=580,//小票宽度
            rowHeight=15,//小票行距
    //获取控件对象
            LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));
    function printPreview(){
        //创建小票打印页
        CreatePrintPage();
        //打印预览
        LODOP.PREVIEW();
    }
    /**
     * 样例函数,服务器确认订单后执行
     */
    function printOrder() {

        //创建小票打印页
        CreatePrintPage();
        //开始打印
        LODOP.PRINT();

    };
    function CreatePrintPage(json) {
        //json 创建模拟服务器响应的订单信息对象
        var json = {"title":"XXXXX订单信息", "name":"张三", "phone": "138123456789", "orderTime": "2012-10-11 15:30:15",
            "orderNo": "20122157481315", "shop":"XX连锁", "total":25.10,"totalCount":6,
            "goodsList":[
                {"name":"菜心(无公害食品)11111111111111111111111111111111111", "price":5.00, "count":2, "total":10.08},
                {"name":"菜心(无公害食品)", "price":5.00, "count":2, "total":10.02},
                {"name":"旺菜", "price":4.50, "count":1, "total":4.50},
                {"name":"黄心番薯(有机食品)", "price":4.50, "count":1, "total":4.50}
            ]
        }

        //初始化
        LODOP.PRINT_INIT("打印控件功能演示_Lodop功能_名片");
        //添加小票标题文本
        LODOP.ADD_PRINT_TEXT(hPos,30,pageWidth,rowHeight,json.title);
        //上边距往下移
        hPos+=rowHeight;

        LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"姓名:");
        LODOP.ADD_PRINT_TEXT(hPos,30,pageWidth,rowHeight,json.name);
        //hPos+=rowHeight; //电话不换行
        LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,"电话:");
        LODOP.ADD_PRINT_TEXT(hPos,100,pageWidth,rowHeight,json.phone);
        hPos+=rowHeight;
        LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"下单时间:");
        LODOP.ADD_PRINT_TEXT(hPos,60,pageWidth,rowHeight,json.orderTime);
        hPos+=rowHeight;
        LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"订单编号:");
        LODOP.ADD_PRINT_TEXT(hPos,60,pageWidth,rowHeight,json.orderNo);
        hPos+=rowHeight;
        LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"取货门店:");
        LODOP.ADD_PRINT_TEXT(hPos,60,pageWidth,rowHeight,json.shop);
        hPos+=rowHeight;
        LODOP.ADD_PRINT_LINE(hPos,2, hPos, pageWidth,2, 1);
        hPos+=5;
        LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"商品名称");
        LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,"单价");
        LODOP.ADD_PRINT_TEXT(hPos,110,pageWidth,rowHeight,"数量");
        LODOP.ADD_PRINT_TEXT(hPos,140,pageWidth,rowHeight,"小计");
        hPos+=rowHeight;
        //遍历json的商品数组
        for(var i=0;i<json.goodsList.length;i++){

            if(json.goodsList[i].name.length<4){
                LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,json.goodsList[i].name);
            }else {
                //商品名字过长,其他字段需要换行
                LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,json.goodsList[i].name);
                hPos+=rowHeight;
            }
            LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,json.goodsList[i].price);
            LODOP.ADD_PRINT_TEXT(hPos,115,pageWidth,rowHeight,json.goodsList[i].count);
            LODOP.ADD_PRINT_TEXT(hPos,140,pageWidth,rowHeight,json.goodsList[i].total);
            hPos+=rowHeight;
        }
        //商品遍历打印完毕,空一行
        hPos+=rowHeight;
        //合计
        LODOP.ADD_PRINT_TEXT(hPos,80,pageWidth,rowHeight,"合计:"+json.totalCount);
        LODOP.ADD_PRINT_TEXT(hPos,130,pageWidth,rowHeight,"￥"+json.total);

        hPos+=rowHeight;
        LODOP.ADD_PRINT_TEXT(hPos,2,pageWidth,rowHeight,(new Date()).toLocaleDateString()+" "+(new Date()).toLocaleTimeString())
        hPos+=rowHeight;
        LODOP.ADD_PRINT_TEXT(hPos,25,pageWidth,rowHeight,"谢谢惠顾,欢迎下次光临!");
        //初始化打印页的规格
        LODOP.SET_PRINT_PAGESIZE(3,pageWidth,45,"XXXXX订单信息");

    };
</script>
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