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
<div class="container-fluid">
    <div class="col-md-3">
        <h2>下拉菜单</h2>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Dropdown
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>

        <h2>按钮组</h2>
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default">Left</button>
            <button type="button" class="btn btn-default">Middle</button>
            <button type="button" class="btn btn-default">Right</button>
        </div>


        <h2>按钮式下拉菜单</h2>
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>


        <h2>分裂式按钮下拉菜单</h2>
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger">Action</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-3">
        <h2>输入框组</h2>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
        </div>

        <div class="input-group">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">@example.com</span>
        </div>

        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-addon">.00</span>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
                    <input type="text" class="form-control" placeholder="Search for...">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div>
    <div class="col-md-3">
        <h2>Togglable tabs</h2>
        <ul id="myTabs" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a></li>
            <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Profile</a></li>
            <li role="presentation" class="dropdown">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                    <li class=""><a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" aria-expanded="false">@fat</a></li>
                    <li class=""><a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2" aria-expanded="false">@mdo</a></li>
                </ul>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <h2>分页</h2>
        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

        <div class="container">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>下单时间</th>
                    <th>桌号</th>
                    <th>单号</th>
                    <th>消费金额</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1分钟前</th>
                    <td>A01</td>
                    <td>001</td>
                    <td>20.00</td>
                    <td><a class="btn btn-primary" href="javascript:;">确认订单</a></td>
                </tr>
                <tr>
                    <th scope="row">1分钟前</th>
                    <td>A01</td>
                    <td>001</td>
                    <td>20.00</td>
                    <td><a class="btn btn-primary" href="javascript:;">确认订单</a></td>
                </tr>
                <tr>
                    <th scope="row">1分钟前</th>
                    <td>A01</td>
                    <td>001</td>
                    <td>20.00</td>
                    <td><a class="btn btn-primary" href="javascript:;">确认订单</a></td>
                </tr>
                <tr>
                    <th scope="row">1分钟前</th>
                    <td>A01</td>
                    <td>001</td>
                    <td>20.00</td>
                    <td><a class="btn btn-primary" href="javascript:;">确认订单</a></td>
                </tr>
                <tr>
                    <th scope="row">1分钟前</th>
                    <td>A01</td>
                    <td>001</td>
                    <td>20.00</td>
                    <td><a class="btn btn-primary" href="javascript:;">确认订单</a></td>
                </tr>
                </tbody>
            </table>
        </div>
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