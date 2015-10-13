/**
 * 菜单service
 * User: hgh
 * Date: 2015/10/12
 * Time: 10:35
 */
define(['angular', '../module.js'], function(angular, module) {
    module.factory('app.MenuService', ['app.ApiService', '$q', '$timeout', function(Api, $q, $timeout) {
        var loadDefer = null;
        var service = {
            data: null,
            /**
             * 加载当前店铺的商品分类
             */
            loadGoodsCategory: function() {
                if (loadDefer) {
                    return loadDefer.promise;
                }

                var defer = $q.defer();
                if(service.data == null) {
                    Api.getGoodsCategory().success(function (res) {
                        if (res.status) {
                            service.data = res.data;
                            defer.resolve(service.data);
                        } else {
                            defer.reject(res.msg);
                        }
                    }).error(function () {
                        defer.reject('网络错误');
                    });
                } else {
                    defer.resolve(service.data);
                }

                // 防止重复加载
                $timeout(function() {
                    defer.promise.finally(function() {
                        loadDefer = null;
                    });
                });

                loadDefer = defer;
                return defer.promise;
            },

            /**
             * 获取当前分类的商品
             * id int 分类ID
             */
            getCategoryGoods: function (id) {
                var defer = $q.defer();
                Api.getCategoryGoods(id).success(function (res) {
                    if (res.status) {
                        defer.resolve(res.data);
                    } else {
                        defer.reject(res.msg);
                    }
                }).error(function () {
                    defer.reject('网络错误');
                });

                return defer.promise;
            }

        };

        return service;
    }]);
});