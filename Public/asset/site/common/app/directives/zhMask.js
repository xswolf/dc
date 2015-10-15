define(['angular', '../module.js'], function (angular, module) {
    module.directive('zhMask', ['$compile', function ($compile) {
        return {
            scope: true,
            controller: ['$scope', function (scope) {
                this.show = function () {
                    scope.showMask = true;
                };

                this.hide = function () {
                    scope.showMask = false;
                };

                this.toggle = function(v) {
                    if (typeof v !== 'undefined') {
                        scope.showMask = v;
                    } else {
                        scope.showMask = !scope.showMask;
                    }
                }
            }],
            link:function(scope, elem) {
                var mask = angular.element('<div class="m-mask" ng-show="showMask"></div>');
                mask.on('click', function() {
                    scope.$broadcast('eMaskClick');
                });
                elem.append($compile(mask)(scope));
            }
        }
    }]);
});