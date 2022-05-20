(function () {
    'use strict';

    /**
     * @param {Scope} scope
     * @param {Function} callback
     */
    angular.safeApply = function (scope, callback) {
        scope[(scope.$$phase || scope.$root.$$phase) ? '$eval' : '$apply'](callback || function () {
            });
    };

    /**
     * Detects if application is loaded under mobile device
     *
     * @todo: optimize method to increase detecting accuracy.
     */
    angular.isMobile = (function (a) {
        return /((iP([oa]+d|(hone)))|Android|WebOS|BlackBerry|windows (ce|phone))/i.test(a);
    })(navigator.userAgent || navigator.vendor || window.opera);

    /**
     * Detects device's online|offline status
     *
     * @returns {WorkerNavigator|Navigator|boolean}
     */
    angular.isOnline = function isOnline() {
        return (window.navigator && window.navigator.onLine);
    };

    angular.findScopeWithProperty = function (scope, prop) {
        var $parent = scope.$parent;
        do {
            if ($parent && $parent.hasOwnProperty(prop)) {
                break;
            } else if (!$parent) {
                return null;
            }
            $parent = $parent.$parent;
        } while (true);

        return $parent;
    };

    angular.trackPage = function (path, title) {
        if (typeof(ga) == 'undefined') {
            return false;
        }

        ga('set', {
            page: path,
            title: title || document.title
        });

        ga('send', 'pageview');
        // console.log(page);
    };
})(angular);

String.prototype.ucfirst = function () {
    var str = (this || '');
    var f = str.charAt(0).toUpperCase();
    return f + str.substr(1, str.length - 1);
};

String.prototype.ucwords = function () {
    var str = (this || '');
    var words = (str || '').split(' ').map(function (word) {
        return word.ucfirst();
    });

    return words.join(' ');
};