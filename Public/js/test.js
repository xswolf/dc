$(function() {
    $('#toast1').click(function() {
        window.app.toast({
            message: '请选择正确的文件类型！[.jpg, .png, .gif]'
        });


    });

});