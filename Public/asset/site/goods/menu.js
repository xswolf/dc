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
            controller: ['$scope', '$timeout', 'app.MenuService',
                function ($scope, $timeout, MenuService) {
                    $scope.menu = [
                        {
                            id: 1,
                            name: '推荐'
                        },
                        {
                            id: 2,
                            name: '三明治'
                        },
                        {
                            id: 3,
                            name: '咖啡'
                        },

                        {
                            id: 4,
                            name: '轻食'
                        },
                        {
                            id: 5,
                            name: '主食'
                        },
                        {
                            id: 6,
                            name: '饮料'
                        },
                        {
                            id: 0,
                            name: '刷新'
                        }
                    ];

                    $scope.loadGoods = function() {
                        console.log('12344');
                    }
                }
            ]
        }
    });
});