/**
 * Created by guoyong on 14-8-21.
 */
var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,';
    var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head></head><body><table border="1">{ table }</table></body></html>';
    var base64 = function(s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    };
    var format = function(s, c) {
        return s.replace(/{ (\w+) }/g,function(m, p) {
            return c[p];
        })
    };
    return function(table, name) {
        var $a = $('.print');
        if (!table.nodeType) table= document.getElementById(table)
        var ctx = { worksheet: name|| 'Worksheet', table: table.innerHTML }

        $a.attr("download", name + ".xls").attr("href", uri+ base64(format(template, ctx)));
        setTimeout(function(){
            $a.attr("href", "javascript: void(0)");
        }, 10);
        //window.location.href = uri+ base64(format(template, ctx))
    }
})();