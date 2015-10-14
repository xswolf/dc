/**
 * goods controller
 * User: hgh
 * Date: 2015/10/12
 * Time: 14:30
 */
define(['./module.js'], function(module) {
    module.controller('goods.Controller', ['$scope', '$stateParams', 'app.MenuService', function($scope, $stateParams, MenuService) {
        $scope.data = {
            goods: []
        };

        if($stateParams.mid && $stateParams.mid > 0);
        else {
            MenuService.getCategoryGoods(0).then(function (data) {
                $scope.data.goods = data;
            }, function (msg) {

            });
        }

    }]);
});