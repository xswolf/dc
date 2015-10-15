define(['../module.js', './zhMask.js'], function (module) {
    module.directive('zhDialog', ['$timeout', function ($timeout) {
        return {
            require: '?^zhMask',
            replace: true,
            link: function (scope, elem, attrs, maskCtr) {
                if (scope.hasMask && maskCtr) {
                    maskCtr.toggle(true); // 显示遮罩
                }
                var container = scope._dom.container;
                $timeout(function() {
                    if (scope.wrapMe) {
                        scope._dom.root.css({
                            position: 'relative',
                            'z-index': scope.cssIndex
                        });
                        // if (scope.width) {
                        //     container.css('width', scope.width + 'px');
                        // }
                        // container.css('margin-left', -(container[0].offsetWidth/2)+'px');
                        // container.css('margin-top', -(container[0].offsetHeight/2)+'px');
                    }
                });

                if (!elem[0].querySelectorAll('[autofocus]').length) {
                    elem[0].focus();
                }
            }
        }
    }]);
});