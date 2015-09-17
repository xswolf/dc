$(function() {

    // 确认订单
    $('.j-confirmBtn').click(function() {
        var $this = $(this);
        var _id = $this.attr('id');

        show($this, _id);
    });
    function show($this, orderId) {
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






});



