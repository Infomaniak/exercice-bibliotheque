/**
 * In this file you can find all route necessary for angular
 */
var appModule = angular.module('routing', []);

/**
 * Main configuration
 */
appModule.config(['$locationProvider', function ($locationProvider) {
    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('');
}]);

appModule.config(['$routeProvider',
    function ($routeProvider) {

        // Routage system
        $routeProvider
            .when('/dashboard', {
                templateUrl: 'partials/dashboard.html',
                controller: 'dashboardController'
            })
            .when('/users', {
                templateUrl: 'partials/users.html'
            });
    }
])
/**
 * Controller for the dashboard
 */
    .controller("dashboardController", function ($scope) {
        //$scope.image_res = image_res;
    });
