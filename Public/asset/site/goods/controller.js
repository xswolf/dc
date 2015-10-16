/**
 * goods controller
 * User: hgh
 * Date: 2015/10/12
 * Time: 14:30
 */
define(['./module.js'], function(module) {
    module.controller('goods.Controller', ['$scope', '$stateParams', 'app.MenuService', 'app.DialogService', function($scope, $stateParams, MenuService, Dialog) {
        $scope.data = {
            goods: []
        };

        if($stateParams.mid && $stateParams.mid > 0);
        else {
            var dialog = Dialog.loading();
            MenuService.getCategoryGoods(0).then(function (data) {
                $scope.data.goods = data;
            }, function (msg) {
                Dialog.alert(msg);
            }).finally(function() {
                dialog.close();
            });
        }

    }]);
});