define(['angular', '../module.js', '../directives/zhDialog.js'], function (angular, module) {
    /**
     * 对话框服务
     * TODO templateUrl 加载
     * TODO height 固定高度
     *
     * 用法:
     * dialog = DialogService.alert('登陆失败');
     * dialog.result.then(function(res, next) { next(); });
     *
     * dialog = DialogService.create({templateUrl:'tmp.html'});
     * dialog.autoClose = false;
     * dialog.result.then(function success(res) { console.log(dialog.scope.result)}, function error(res) {});
     */
    module.provider('app.DialogService', function () {

        var provider = {
            options: {
                template: '',
                templateUrl: '',
                controller: null,
                controllerAs: '',
                title: '提示',
                width: 260,
                height: null,
                containerClass: '',
                skinClassName: '',
                hasMask: true,
                textOkBtn: '确定',
                textCancelBtn: '取消',
                result: null, // 运行结果
                ok: null, // OK 按钮回调
                cancel: null, // Cancel 按钮回调
                cssIndex: 0,   // 基准
                wrapMe: true, // 是否包裹弹出层
                calcPos: true,
                _dom: {}
            },
            $get: ['$compile', '$document', '$rootScope', '$timeout', '$controller', function ($compile, $document, $rootScope, $timeout, $controller) {
                var dlg = {};

                dlg.create = function (options) {
                    options = angular.extend({}, provider.options, options);
                    var html = angular.element('<div zh-dialog></div>');
                    var container = angular.element('<div ng-class="{popupBox:wrapMe}" class="{{containerClass}} {{skinClassName}}"></div>');
                    container.append(options.template);
                    options._dom.container = container;

                    html.append(container);

                    if (options.hasMask) {
                        var mask = angular.element('<div zh-mask></div>');
                        html = mask.append(html);
                    }

                    var scope = $rootScope.$new();
                    scope = angular.extend(scope, options);

                    var dialog = new Dialog(html, scope);

                    // 设置默认回调
                    if (!scope.ok) {
                        scope.ok = function (v) {
                            dialog.ok(v);
                        };
                    }
                    if (!scope.cancel) {
                        scope.cancel = function (v) {
                            dialog.cancel(v);
                        };
                    }

                    if (options.controller) {
                        var ctrlScope = angular.extend({$scope: scope}, options);
                        var ctrlIns = $controller(options.controller, ctrlScope);
                        if (options.controllerAs) {
                            scope[options.controllerAs] = ctrlIns;
                        }
                    }

                    // 默认隐藏
                    html.css('display', 'none');

                    $compile(html)(scope);
                    $document.find('body').append(html);
                    scope._dom.root = html;

                    return dialog;
                };

                dlg.alert = function (tpl, title, options) {
                    options = options || {};

                    if (angular.isDefined(title)) {
                        options.title = title;
                    }

                    options = angular.extend({
                        template: '<div class="popup-hd">{{title}}</div>' +
                        '<div class="popup-bd">' +tpl+ '</div>' +
                        '<div class="popup-ft">' +
                        '   <a class="popup-okBtn" href="javascript:;" ng-click="ok(true)">{{textOkBtn}}</a>' +
                        '</div>'
                    }, options);

                    var dialog = dlg.create(options);
                    dialog.show();                    

                    return dialog;
                };

                dlg.confirm = function (tpl, title, options) {
                    options = angular.extend({
                        template: '<div class="popup-hd">{{title}}</div>' +
                        '<div class="popup-bd">' +tpl+ '</div>' +
                        '<div class="popup-ft">' +
                        '   <div class="popup-confirm-ft">' +
                        '       <a class="popup-cancelBtn" href="javascript:;" ng-click="cancel(false)">{{textCancelBtn}}</a><a class="popup-okBtn" href="javascript:;" ng-click="ok(true)">{{textOkBtn}}</a>' +
                        '   </div>' +
                        '</div>'
                    }, options || {});

                    if (angular.isDefined(title)) {
                        options.title = title;
                    }

                    var dialog = dlg.create(options);
                    dialog.show();                    

                    return dialog;
                };

                dlg.prompt = function (value, title, attrs, options) {
                    attrs = angular.isDefined(attrs)? attrs : {};
                    options = options || {};

                    var attrStr = '';
                    for (var i in attrs) {
                        if (attrs.hasOwnProperty(i)) {
                            attrStr += i + '="' + attrs[i] + '" ';
                        }
                    }

                    if (angular.isDefined(title)) {
                        options.title = title;
                    }

                    options = angular.extend({
                        result:{value:value},
                        template: '<div class="popup-hd">{{title}}</div>' +
                        '<div class="popup-bd"><div class="promptInputWrapper"><input class="popup-promptInput" ng-model="result.value" '+ attrStr +' autofocus /></div></div>' +
                        '<div class="popup-ft">' +
                        '   <div class="popup-confirm-ft">' +
                        '       <a class="popup-cancelBtn" href="javascript:;" ng-click="cancel(false)">{{textCancelBtn}}</a><a class="popup-okBtn" href="javascript:;" ng-click="ok(true)">{{textOkBtn}}</a>' +
                        '   </div>' +
                        '</div>'
                    }, options);

                    var dialog = dlg.create(options);
                                        
                    dialog.show();                    

                    return dialog;
                };

                var loadingCache = [];
                dlg.loading = function (tpl) {
                    tpl = tpl || '';
                    var loading = dlg.create({
                        calcPos: false,
                        containerClass: 'popup-loading',
                        width:'100%',
                        template: '<div class="popup-bd">' +
                        '<div class="loading">' +
                        '   <div class="spinner">' +
                        '       <div class="spinner-container container1">' +
                        '           <div class="circle1"></div>' +
                        '           <div class="circle2"></div>' +
                        '           <div class="circle3"></div>' +
                        '           <div class="circle4"></div></div>' +
                        '           <div class="spinner-container container2">' +
                        '               <div class="circle1"></div>' +
                        '               <div class="circle2"></div>' +
                        '               <div class="circle3"></div>' +
                        '               <div class="circle4"></div>' +
                        '           </div>' +
                        '       </div>' +
                        '       <div class="loading-txt">' +tpl+ '</div>' +
                        '   </div>' +
                        '</div>'
                    });

                    if (loadingCache.length > 0) {
                        for (var i=0; i<loadingCache.length; i++) {
                            loadingCache.pop().close();
                        }
                    }

                    loading.show();

                    loadingCache.push(loading);

                    return loading;
                };


                dlg.toast = function(tpl, type, delay) {
                    type = type || 'message';
                    delay = delay || 3000;
                    var animCssIn = 'a-bouncein';
                    var animCssOut = 'a-bounceout';

                    var toast = dlg.create({
                        containerClass: '',
                        width:null,
                        hasMask: false,
                        wrapMe: false,
                        template: '<div class="ui-toast anim '+ type +' '+ animCssIn +'"><div class="ui-toast-inner">' +tpl+ '</div></div>'
                    });                    

                    toast.show();

                    $timeout(function() {
                        toast.close();
                    }, delay);

                    return toast;
                };

                return dlg;
            }]
        };

        return provider;
    });

    var Dialog;
    var $injector = angular.injector(['ng']);
    $injector.invoke(['$q', function ($q) {
        /**
         * 对话框实例
         * @param elem
         * @param scope
         * @constructor
         */
        Dialog = function (elem, scope) {
            this.elem = elem;
            this.scope = scope;
            this.defer = $q.defer();
            this.result = this.defer.promise;
            this.autoClose = true;
            this.closed = false;

            this.result.finally(angular.bind(this, function() {
                if (this.autoClose) {
                    this._close();
                }
            }));
        };

        Dialog.prototype.show = function() {

            this.elem.css('display', 'block');
            this._calcPos(this.scope);
        };

        Dialog.prototype.hide = function() {
            this.elem.css('display', 'none');
        };

        Dialog.prototype.ok = function (value) {
            this.defer.resolve(value);
        };

        Dialog.prototype.cancel = function (value) {
            this.defer.reject(value);
        };

        Dialog.prototype.close = function (value) {
            this.defer.reject(value);
        };

        Dialog.prototype._close = function () {
            if (!this.closed) {
                this.elem.remove();
                this.scope.$destroy();
                this.closed = true;
            }
        };

        Dialog.prototype._calcPos = function (scope) {
            var container = scope._dom.container;


            if (scope.width) {
                container.css('width', scope.width + 'px');
            }
            if (scope.calcPos) {
                container.css('margin-left', -(container[0].offsetWidth/2)+'px');
                container.css('margin-top', -(container[0].offsetHeight/2)+'px');
            }
            
        };
    }]);
});