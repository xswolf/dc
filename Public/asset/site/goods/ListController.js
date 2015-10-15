/**
 * List controller
 * User: hgh
 * Date: 2015/10/12
 * Time: 15:26
 */
define(['angular', './module.js'], function(angular, module) {
    module.controller('goods.ListController',['$scope', '$stateParams', '$q', '$location','app.MenuService', 'app.CartService', 'app.DialogService', function($scope, $stateParams, $q, $location, MenuService, CartService, Dialog) {
        $scope.data = {
            mid: $stateParams.mid,
            goods: []
        };

        if($scope.data.mid > 0) {
            var dialog = Dialog.loading();
            MenuService.getCategoryGoods($scope.data.mid).then(function (data) {
                $scope.data.goods = data;
            }, function (msg) {
                Dialog.alert(msg);
            }).finally(function() {
                dialog.close();
            });
        }

        /**
         * 购物车商品数量
         * @returns {*}
         */
        $scope.cartSelected = function() {
            return CartService.selected();
        };

        $scope.plus = function(goods, number) {
            CartService.add(goods, number);
        };

        $scope.minus = function (goods, number) {
            CartService.minus(goods.id, number);
        };

        $scope.getSpecNumber = function(goods) {
            return CartService.goodsSelected(goods.id);
        };

        $scope.goodsSelectedNumber = function(gid) {
            if(CartService.goodsSelected(gid) > 0) {
                return true;
            } else {
                return false;
            }
        };

    }]);
});