/**
 * Created by hgh on 2015/10/14.
 */
define(['angular', './module.js'], function(angular, module) {
    module.controller('order.Controller',['$scope', function($scope) {
        $scope.ui = {
            page: {
                list: true,
                payment: false,
                remark: false
            }
        };

        $scope.writeRemark = function() {

        };

        /**
         * 显示页面
         * @param name
         */
        $scope.showPage = function(name) {
            angular.forEach($scope.ui.page, function(v, i) {
                $scope.ui.page[i] = false;
            });
            $scope.ui.page[name] = true;
        };

    }]);
});