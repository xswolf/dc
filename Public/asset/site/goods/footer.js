/**
 * 购物车页脚
 * User: hgh
 * Date: 2015/10/12
 * Time: 16:00
 */
define(['./module.js'], function(module) {
    module.directive('footerDirective', function () {
        return {
            restrict: 'A',
            scope: {
                id: '@'
            },
            replace: true,
            templateUrl: 'tpl-footer.html',
            controller: ['$scope', '$window', 'app.CartService',
                function ($scope, $window, CartService) {
                    $scope.totalPrice = function() {
                      return CartService.total();
                    };

                    $scope.orderList = function() {
                        $window.location = '/site/order/list';
                    }
                }
            ]
        }
    });
});