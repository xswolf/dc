/**
 * goods controller
 * User: hgh
 * Date: 2015/10/12
 * Time: 14:30
 */
define(['./module.js'], function(module) {
    module.controller('goods.Controller', ['$scope', 'app.MenuService', function($scope, MenuService) {
        $scope.data = {
            goods: []
        };

        MenuService.getCategoryGoods(0).then(function(data) {
            $scope.data.goods = data;
        }, function(msg) {

        });
    }]);
});