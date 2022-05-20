var Unica = angular.module('Unica', ['templates', 'ngMaterial', 'angular-storage'], function () {
});

/**
 * Site URL
 * @type {string}
 */
Unica.SITE_URL = 'http://' + location.host;
Unica.SECURE_SITE_URL = 'https://' + location.host;

/**
 * JsonRPC Api URL
 * @type {string}
 */
Unica.API_URL = (Unica.SITE_URL + '/api/v1');
Unica.COOKIE_NAME = 'unica_nutrition';

Unica.config(['$mdThemingProvider', function UnicaConfig($mdThemingProvider) {
    // make placeholders color darkness
    $mdThemingProvider.theme('default').foregroundPalette[3] = 'rgba(0,0,0,0.76)'
}]);

Unica.STORAGE = 'session';

Unica.run(['$rootScope', function ($rootScope) {
    // handle ajax|routeChange requests
    (function ($rootScope) {
        $rootScope.loadingView = false;
        $rootScope.loadingError = false;

        $rootScope.$on('$loadingResults', function (e, value) {
            $rootScope.loadingView = value;
        });
        $rootScope.$on('$routeChangeStart', function (e, curr) {
            if (curr.$$route && curr.$$route.resolve) {
                // Show a loading message until promises are not resolved
                $rootScope.loadingView = true;
                $rootScope.loadingError = false;
            }
        });
        $rootScope.$on('$routeChangeSuccess', function () {
            // Hide loading message
            $rootScope.loadingView = false;
            $rootScope.loadingError = false;
        });
        $rootScope.$on('$routeChangeError', function () {
            // Hide loading message
            $rootScope.loadingView = false;
            $rootScope.loadingError = true;
        });
    })($rootScope);
}]);
