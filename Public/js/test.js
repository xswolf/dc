$(function() {
    $('#toast1').click(function() {
        window.app.toast({
            message: '请选择正确的文件类型！[.jpg, .png, .gif]'
        });
    });



    $('.j-confirm1').click(function() {
        window.app.confirm({
            content: 'confirm内容',
            handler4ConfirmBtn: function() {
                alert(1);
            }
        })
    });

    $('.j-alert1').click(function() {
        window.app.alert({
            content: 'alert内容',
            handler4AlertBtn: function() {
                alert(2);
            }
        })
    });
});