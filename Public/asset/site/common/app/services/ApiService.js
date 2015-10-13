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


        /**
         * 加载商品分类
         */
        api.getGoodsCategory = function() {
            return $http.get('/site/goods/get_goods_category');
        };

        /**
         * 获取分类下的商品
         */
        api.getCategoryGoods = function(id) {
            return $http.get('/site/goods/get_category_goods?id='+id);
        };

        return api;
    }]);
});