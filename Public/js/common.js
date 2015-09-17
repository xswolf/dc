(function($) {

    window.app = window.app || {};

    window.app.form = [];

    // 初始化组件
    window.app.init = function() {
        bootstrapInit();
        pluginsInit();
    };

    window.app.init();


    // bootstrap init
    function bootstrapInit() {
        $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip();
    }


    // plugins init
    function pluginsInit() {
        // bootstrapValidator
        if($.fn.bootstrapValidator){
            $('.j-validator').each(function() {
                $(this).bootstrapValidator({
                    message: '请输入有效的值',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    }
                });

                window.app.form.push(
                    $(this).data('bootstrapValidator')
                );
            });

        }
    }
})(jQuery);