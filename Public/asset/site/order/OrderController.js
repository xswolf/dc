/**
 * Created by hgh on 2015/10/14.
 */
define(['./module.js'], function(module) {
    module.controller('order.Controller',[
        '$scope', '$timeout', '$q', '$location',
        'app.ApiService', 'app.CartService', 'app.DialogService',
    function($scope, $timeout, $q, $location, Api, CartService, Dialog) {
        $scope.ui = {
            page: {
                list: true,
                remark: false
            },
            remark_value:'',
            c:null
        };

        /**
         * 备注
         */
        $scope.writeRemark = function(c) {
            $scope.showPage('remark');
            $scope.ui.remark_value = c.remark;
            $scope.ui.c = c;
        };

        /**
         * 保存备注
         */
        $scope.saveRemark = function() {
            $scope.ui.c.remark = $scope.ui.remark_value;
            CartService.save();
            $scope.showPage('list');
        };

        $scope.cart = CartService.data;

        $scope.totalPrice = function() {
            return CartService.total();
        };

        $scope.selectedNumber = function() {
            return CartService.selected();
        };

        /**
         * 提交订单,微信支付
         */
        $scope.submitWxOrder = function() {
            submitOrder().then(function(data) {
                location.href = '/site/order/pay?id=' + data.id;
            });
        };

        function submitOrder() {
            var data = prepareOrder();
            var loading = Dialog.loading();
            var defer = $q.defer();
            Api.submitOrder(data.goods)
                .success(function(res) {
                    if (res.status) {
                        Dialog.toast('下单成功');
                        $timeout(function() {
                            CartService.clean();
                        });
                        defer.resolve(res.data);
                    } else {
                        Dialog.alert(res.msg);
                        defer.reject();
                        loading.close();
                    }
                }).error(function() {
                    loading.close();
                    Dialog.alert('下单失败');
                    defer.reject();
                });

            return defer.promise;
        }

        /**
         * 准备提交订单的数据
         * @returns {{goods: Array}}
         */
        function prepareOrder() {
            var data = {
                goods: []
            };
            // 商品
            angular.forEach($scope.cart, function (c) {
                data.goods.push({gid: c.gid, number: c.number, remark: c.remark});
            });
            return data;
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
            Dialog.confirm('确定不点我吗?').result.then(function () {
                $scope.$apply(function () {
                    CartService.remove(c.gid);
                });
            });
        };

    }]);
});