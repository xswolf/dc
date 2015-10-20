/**
 * Created by Administrator on 2015/10/12.
 */
var LODOP;          //声明为全局变量

var pageWidth=580,  //小票宽度
    rowHeight=15,   //小票行距
//获取控件对象
    LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));

// 打印预览
function printPreview(){
    //创建小票打印页
    CreatePrintPage();
    //打印预览
    LODOP.PREVIEW();
}
/**
 * 服务器确认订单后执行打印订单
 */
function printOrder(json , printList) {

    for (i in printList){
        //创建小票打印页
        CreatePrintPage(json);
        //开始打印

        LODOP.SET_PRINTER_INDEX(printList[i].name);

        LODOP.PRINT();
    }


};
function CreatePrintPage(json) {
    var hPos=10;        //小票上边距
    //json 创建模拟服务器响应的订单信息对象
    //var json = {"title":"订单信息", "name":"admin", "phone": "138123456789", "orderTime": "2012-10-11 15:30:15",
    //    "orderNo": "20122157481315", "shop":"XX连锁", "total":25.10,"totalCount":6,
    //    "goodsList":[
    //        {"name":"菜心(无公害食品)11111111111111111111111111111111111", "price":5.00, "count":2, "total":10.08},
    //        {"name":"菜心(无公害食品)", "price":5.00, "count":2, "total":10.02},
    //        {"name":"旺菜", "price":4.50, "count":1, "total":4.50},
    //        {"name":"黄心番薯(有机食品)", "price":4.50, "count":1, "total":4.50}
    //    ]
    //}

    //初始化
    LODOP.PRINT_INIT("打印控件功能演示_Lodop功能_名片");
    //添加小票标题文本
    LODOP.ADD_PRINT_TEXT(hPos,10,pageWidth,rowHeight,json.title);

    LODOP.SET_PRINT_STYLEA(0,"FontName","隶书");
    LODOP.SET_PRINT_STYLEA(0,"FontSize",12);
    //上边距往下移
    hPos+=rowHeight+10;




    LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"桌号:");

    LODOP.SET_PRINT_STYLEA(0,"FontName","隶书");
    LODOP.SET_PRINT_STYLEA(0,"FontSize",12);

    LODOP.ADD_PRINT_TEXT(hPos,40,pageWidth,rowHeight,json.tableId);

    LODOP.SET_PRINT_STYLEA(0,"FontName","隶书");
    LODOP.SET_PRINT_STYLEA(0,"FontSize",12);

    //hPos+=rowHeight; //电话不换行
    LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,"下单时间:");
    LODOP.ADD_PRINT_TEXT(hPos,130,pageWidth,rowHeight,json.orderTime);
    hPos+=rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"订单编号:");
    LODOP.ADD_PRINT_TEXT(hPos,60,pageWidth,rowHeight,json.orderNo);
    hPos+=rowHeight;
    LODOP.ADD_PRINT_LINE(hPos,2, hPos, pageWidth,2, 1);
    hPos+=5;
    LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,"商品名称");
    LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,"单价");
    LODOP.ADD_PRINT_TEXT(hPos,120,pageWidth,rowHeight,"数量");
    LODOP.ADD_PRINT_TEXT(hPos,150,pageWidth,rowHeight,"小计");
    LODOP.ADD_PRINT_TEXT(hPos,190,pageWidth,rowHeight,"备注");

    hPos+=rowHeight;
    //遍历json的商品数组

    LODOP.ADD_PRINT_LINE(hPos,2, hPos, pageWidth,2, 1);

    hPos+=rowHeight;

    var sum = 0;

    for(var i=0;i<json.goodsList.length;i++){

        if(json.goodsList[i].name.length<=8){
            LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,json.goodsList[i].name);
        }else {
            //商品名字过长,其他字段需要换行
            LODOP.ADD_PRINT_TEXT(hPos,1,pageWidth,rowHeight,json.goodsList[i].name);
            hPos+=rowHeight;
        }
        LODOP.ADD_PRINT_TEXT(hPos,70,pageWidth,rowHeight,json.goodsList[i].order_goods_price);
        LODOP.ADD_PRINT_TEXT(hPos,120,pageWidth,rowHeight,json.goodsList[i].number);
        LODOP.ADD_PRINT_TEXT(hPos,150,pageWidth,rowHeight,json.goodsList[i].number * json.goodsList[i].order_goods_price);
        LODOP.ADD_PRINT_TEXT(hPos,190,pageWidth,rowHeight,json.goodsList[i].mark);
        hPos+=rowHeight;
        sum += json.goodsList[i].number * json.goodsList[i].order_goods_price;
    }
    //商品遍历打印完毕,空一行
    hPos+=rowHeight;
    //合计
    LODOP.ADD_PRINT_TEXT(hPos,190,pageWidth,rowHeight,"合计:"+sum);

    //hPos+=rowHeight;
    //LODOP.ADD_PRINT_TEXT(hPos,2,pageWidth,rowHeight,(new Date()).toLocaleDateString()+" "+(new Date()).toLocaleTimeString())
    hPos+=rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos,25,pageWidth,rowHeight,"——————中恒玖联技术支持——————");
    //初始化打印页的规格
    LODOP.SET_PRINT_PAGESIZE(3,pageWidth,45,"XXXXX订单信息");

}

function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
}