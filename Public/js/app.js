$(function() {

    // 确认订单
    $('.j-confirmBtn').click(function() {
        var $this = $(this);
        var _id = $this.attr('id');

        confirmOrder($this, _id);
    });
    // 删除确认提示
    $('.j-delTable').click(function() {
        var $this = $(this);
        var _id = $this.attr('id');

        delConfirm($this, _id);
    });







    // 确认订单
    function confirmOrder($this, orderId) {
        // ajax
        if (true) {
            window.app.toast({
                message: '确认订单成功！'
            });

            $this.parents('tr').next('tr').remove();
            $this.parents('tr').remove();
        } else {
            window.app.toast({
                message: '确认订单失败！',
                type: 'error'
            });
        }
    }
    // 删除确认提示
    function delConfirm($this, tableId) {
        // ajax
        window.app.confirm({
            content: '是否删除？',
            handler4ConfirmBtn: function() {
                // ajax
                if(true){
                    // 删除订单成功
                    $this.parents('tr').remove();
                    window.app.toast({
                        message: '删除桌号成功！'
                    });
                }else{

                }
            }
        });
    }


});



