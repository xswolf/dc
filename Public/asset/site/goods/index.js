/**
 * Created by hgh on 2015/10/10.
 */
define([
    'angular',
    './module.js',
    'ui.router',
    'ngAnimate',
    './Controller.js',
    './ListController.js',
    './menu.js',
    './footer.js'
], function(angular, module) {
    module.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("/");
        $stateProvider.state('list', {
            url: "/",
            controller: 'goods.ListController',
            templateUrl: 'tpl-list.html'
        });
    }]);

    return module;
});