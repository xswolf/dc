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


        /**
         *  toast
         *  window.app.toast({
                message: '请选择正确的文件类型！[.jpg, .png, .gif]',
                type: 'info'
            });
         */
        if(window.toastr){
            window.app.toast = function (opts) {
                var _defaults = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "showDuration": "400",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "preventDuplicates": true, // 防止重复
                    // "newestOnTop": false,    // 默认显示新信息在上
                    "type": "success", //默认success, info, warning, error
                    "title": "提示",
                    "message": ""
                };

                _opts = $.extend({}, _defaults, opts);

                toastr.options = _opts;

                toastr[toastr.options.type](toastr.options.message, toastr.options.title);
            };
        }
    }
})(jQuery);