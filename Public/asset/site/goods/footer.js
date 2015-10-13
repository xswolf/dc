/**
 * 菜单
 * User: hgh
 * Date: 2015/10/12
 * Time: 16:00
 */
define(['./module.js'], function(module) {
    module.directive('footerDirective', function () {
        return {
            restrict: 'A',
            scope: {
                id: '@'
            },
            replace: true,
            templateUrl: 'tpl-footer.html',
            controller: ['$scope', '$timeout', 'app.GoodsService',
                function ($scope, $timeout, GoodsService) {

                }
            ]
        }
    });
});