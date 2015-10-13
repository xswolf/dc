/**
 * Api 接口service
 * User: hgh
 * Date: 2015/10/12
 * Time: 10:35
 */
define(['angular', '../module.js'], function(angular, module) {
    module.factory('app.ApiService', ['$http', function($http) {
        var api = {};

        /**
         * 获取商品列表
         * @param int id 商品分类ID
         */
        api.getGoods =  function(id) {
            return $http.get('/site/goods/goods_list?id='+id);
        };


        return api;
    }]);
});