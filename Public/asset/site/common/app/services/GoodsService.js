/**
 * 商品service
 * User: hgh
 * Date: 2015/10/12
 * Time: 10:35
 */
define(['angular', '../module.js'], function(angular, module) {
    module.factory('app.GoodsService', ['app.ApiService', '$q', function(Api, $q) {
        var service = {
            load: function(id) {
                var defer = $q.defer;
                Api.getGoods(id).then(function(res) {
                    if(res.data.status) {
                        defer.resolve(res.data.data);
                    } else {
                        defer.reject(res.data.msg);
                    }
                }, function() {
                    defer.reject('获取商品列表失败');
                });

                return defer.promise;
            }
        };

        return service;
    }]);
});