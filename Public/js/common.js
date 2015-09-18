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



        // dialog
        window.app.confirm = function(cfg) {
            new Dialog().show($.extend(cfg, {type: 'confirm'}));
        };
        window.app.alert = function(cfg) {
            new Dialog().show($.extend(cfg, {type: 'alert'}));
        };

        function Dialog() {
            this.cfg = {
                title: '提示',
                content: '',
                type: 'confirm',

                text4OkBtn: '确定',
                text4CancelBtn: '取消',

                handler4AlertBtn: null,
                handler4CloseBtn: null,
                handler4ConfirmBtn: null,
                handler4CancelBtn: null
            };
            this.tpl = null;
        }

        Dialog.prototype.bindUI = function() {
            var _this = this;
            _this.tpl.on('shown.bs.modal', function() {

            });

            _this.tpl.on('hidden.bs.modal', function() {
                _this.tpl.remove();
                _this.tpl.off();
            });

            this.tpl.on('click', '.j-confirmBtn', function() {
                if(_this.cfg.handler4ConfirmBtn){
                    _this.cfg.handler4ConfirmBtn();
                }
                _this.tpl.modal('hide');
            });

            this.tpl.on('click', '.j-cancelBtn', function() {
                if(_this.cfg.handler4CancelBtn){
                    _this.cfg.handler4CancelBtn();
                }
                _this.tpl.modal('hide');
            });

            this.tpl.on('click', '.j-alertBtn', function() {
                if(_this.cfg.handler4AlertBtn){
                    _this.cfg.handler4AlertBtn();
                }
                _this.tpl.modal('hide');
            });

        };

        Dialog.prototype.renderUI = function() {
            var _this = this;
            var _footer = '';

            switch (_this.cfg.type){
                case 'confirm':
                    _footer = '<button type="button" class="btn btn-default j-cancelBtn">'+this.cfg.text4CancelBtn+'</button><button type="button" class="btn btn-primary j-confirmBtn">'+this.cfg.text4OkBtn+'</button>';
                    break;
                case 'alert':
                    _footer = '<button type="button" class="btn btn-danger j-alertBtn">'+this.cfg.text4CancelBtn+'</button>';
                    break;
            }

            this.tpl = $('<div class="modal fade">'+
                '<div class="modal-dialog">'+
                '<div class="modal-content">'+
                '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h4 class="modal-title">'+this.cfg.title+'</h4>'+
                '</div>'+
                '<div class="modal-body">'+this.cfg.content+'</div>'+
                '<div class="modal-footer">'+_footer+'</div>'+
                '</div>'+
                '</div>'+
                '</div>');
        };

        Dialog.prototype.show = function(cfg) {
            $.extend(this.cfg, cfg);


            this.renderUI();
            this.bindUI();

            this.tpl.modal();
        };

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





















