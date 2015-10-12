/**
 * Created by hgh on 2015/10/10.
 */
var app = angular.module('goods', []);
app.controller('goods.Controller', ['$scope', function($scope) {
    $scope.numbers = 600;
    $scope.price = 899;
}]);