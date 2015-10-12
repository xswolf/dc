/**
 * Created by Administrator on 2015/7/24.
 * dataTables 引入这个文件，在table标签加上class属性j-dataTables即可，若想添加搜索功能，在th标签中加入 data-name属性
 */
$(function () {
    $.extend($.fn.dataTable.defaults, {
        bAutoWidth: false,
        searching: true,
        ordering: false,
        bFilter: false,
        stateSave: true,
        dom: 'T<"clear">rt<"bottom"<"pull-left"l>p>',
        //dom: 'T<"clear">lrtip',

        tableTools: {
            sSwfPath: "/Public/Common/js/plugin/dataTables/swf/copy_csv_xls_pdf.swf"
        },

        stateLoadParams: function (settings, data) {
            // 每次初始化之前,检查__save_datatable_state__是否为0
            // 如果为0, 则清除上次保存的筛选信息, 完全初始化表格
            var flag = 0;
            if (flag == 1) {
                // 不清除,还原状态位,还原筛选条件
                //getFilterInput();
                localStorage.setItem('__save_datatable_state__', 0);
                localStorage.removeItem('__save_datatable_filter__');
            } else {
                this.api().state.clear();
                return false;
            }
        },
        sPaginationType: "full_numbers",
        language: {
            "sLengthMenu": "每页显示 _MENU_ 条记录",
            "sZeroRecords": "抱歉， 没有找到",
            "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
            "sInfoEmpty": "没有数据",
            "sEmptyTable": "没有数据",
            "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
            "sSearch": "名称:",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "前一页",
                "sNext": "后一页",
                "sLast": "尾页"
            }
        }
    });
    var table = $(".j-dataTables").DataTable();

    function Filter(dom, type , table) {
        this.dom    = dom;
        this.type   = type;
        this.table  = table;
        this.col    = null;

        var curCol = this.dom.data('col');
        if (curCol == parseInt(curCol , 10)){
            this.col = curCol
        }else{
            this.col = this.table.column(curCol).index();
        }

        var method = 'init' + type;
        this[method] ? this[method].call(this) : alert(method+'方法不存在');
    }

    Filter.prototype.search = function (settings, data, dataIndex) {
        var _this = this;
        var method = "search"+_this.type;
        return this[method] ? this[method].call(this, settings, data, dataIndex) : true;
    }

    // 事件初始化
    Filter.prototype.initTextLike = function () {
        var _this = this;
        var col = this.col;
        _this.dom.keyup(function () {
            var value = _this.dom.val();
            _this.table.column(col).search(value).draw();

        })
    }

    Filter.prototype.initText = function(){
        this.initTextLike();
    }


    // 值过滤
    Filter.prototype.searchText = function (settings, data, dataIndex) {
        var _this = this;
        var textVal = _this.dom.val();
        return textVal == data[this.col];
    }

    Filter.prototype.searchSelect = function () {

    }

    Filter.prototype.searchRadio = function () {

    }

    Filter.prototype.searchChecked = function () {

    }

    Filter.prototype.searchRange = function () {

    }

    var filter = [];
    $(".j-filter").each(function () {
        var $this = $(this);
        var type = null;
        if ($this.is('.j-text-like')) {
            type = 'TextLike';
        } else if ($this.is('.j-text')) {
            type = 'Text';
        } else if ($this.is('.j-select')) {
            type = 'Select';
        } else if ($this.is('.j-radio')) {
            type = 'Radio';
        } else if ($this.is('.j-checked')) {
            type = 'Checked';
        } else if ($this.is('.j-like')) {
            type = 'Like';
        } else if ($this.is('.j-range')) {
            type = 'Range';
        }
        var f = new Filter($this, type , table);

        filter.push(f);
    });

    //$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    //    // 执行过滤操作
    //    for (var i in filter) {
    //        var result = filter[i].search(settings, data, dataIndex);
    //        return result;
    //    }
    //})

});