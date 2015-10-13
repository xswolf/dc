/**
 * Created by hgh on 2015/10/10.
 */
define([
    'angular',
    './module.js',
    'ui.router',
    'ngAnimate',
    './controller.js',
    './ListController.js',
    './menu.js',
    './footer.js'
], function(angular, module) {
    module.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("/");
        $stateProvider.state('list', {
            url: "/",
            controller: 'goods.Controller',
            templateUrl: 'tpl-list.html'
        }).state('list-id', {
            url: "/list/{mid:int}",
            controller: 'goods.ListController',
            templateUrl: 'tpl-list.html'
        });
    }]);

    return module;
});