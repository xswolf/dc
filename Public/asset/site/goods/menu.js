/**
 * 菜单
 * User: hgh
 * Date: 2015/10/12
 * Time: 16:00
 */
define(['./module.js'], function(module) {
    module.directive('menuDirective', function () {
        return {
            restrict: 'A',
            scope: {
                current: '@'
            },
            replace: true,
            templateUrl: 'tpl-menu.html',
            controller: ['$scope', '$stateParams', '$location', 'app.MenuService',
                function ($scope, $stateParams, $location, MenuService) {
                    $scope.category = null;
                    $scope.category_id = $stateParams.mid;
                    MenuService.loadGoodsCategory().then(function(data) {
                        $scope.category = data;
                    },function(msg) {

                    });

                    $scope.loadGoods = function(id) {
                        $location.path('list/' + id);
                    }
                }
            ]
        }
    });
});