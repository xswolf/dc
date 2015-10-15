/**
 * Created by hgh on 2015/10/14.
 */
define(['./module.js'], function(module) {
    module.controller('order.Controller',[
        '$scope', '$timeout', '$q', '$location', 'app.ApiService', 'app.CartService', 'app.DialogService',
        function($scope, $timeout, $q, $location, ApiService, CartService, DialogService) {
        $scope.ui = {
            page: {
                list: true,
                payment: false,
                remark: false
            }
        };

        /**
         * 填写备注
         */
        $scope.writeRemark = function() {

        };

        $scope.cart = CartService.data;

        $scope.totalPrice = function() {
            return CartService.total();
        };

        $scope.selectedNumber = function() {
            return CartService.selected();
        }

        /**
         * 显示页面
         * @param name
         */
        $scope.showPage = function(name) {
            angular.forEach($scope.ui.page, function(v, i) {
                $scope.ui.page[i] = false;
            });
            $scope.ui.page[name] = true;
        };

        /**
         * 减少购物车商品数量
         * @param c
         */
        $scope.minus = function (c) {
            if (c.number - 1 <= 0) {
                $scope.remove(c);
            } else {
                CartService.minus(c.gid);
            }
        };

        /**
         * 增加购物车商品数量
         * @param c
         */
        $scope.plus = function (c) {
            CartService.plus(c.gid);
        };

        /**
         * 直接删除菜品
         * @param c
         */
        $scope.remove = function(c) {
            DialogService.confirm('确定不点我吗?').result.then(function () {
                $scope.$apply(function () {
                    CartService.remove(c.gid);
                });
            });
        };

    }]);
});