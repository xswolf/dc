/**
 * Created by hgh on 2015/10/10.
 */
define([
    'angular',
    './module.js',
    'ngTouch',
    /* Directives */
    /* Filters */
    /* Services */
    './services/ApiService.js',
    './services/StorageService.js',
    './services/CartService.js',
    './services/GoodsService.js',
    './services/MenuService.js'
    /* classes */
], function(angular, module) {
    module.config(['$httpProvider', function($httpProvider){
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformRequest = [function(data) {
            return angular.isObject(data) && String(data) !== '[object File]' ? $.param(data) : data;//使用jQuery的param方法把JSON数据转换成字符串形式
        }];
    }]);
    return module;
});