/**
 * List controller
 * User: hgh
 * Date: 2015/10/12
 * Time: 15:26
 */
define(['angular', './module.js'], function(angular, module) {
    module.controller('goods.ListController',['$scope', '$stateParams', '$q', '$location','app.MenuService', function($scope, $stateParams, $q, $location, MenuService) {
        $scope.data = {
            mid: $stateParams.mid,
            goods: []
        };

        MenuService.getCategoryGoods($scope.data.mid).then(function(data) {
            $scope.data.goods = data;
        }, function(msg) {

        });

    }]);
});