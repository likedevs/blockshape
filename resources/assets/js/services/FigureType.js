Unica.factory('FigureType', [function() {
    var factory = {};

    factory.detect = function($buttocks, $shoulders) {
        if ($buttocks - $shoulders >= 6) {
            return 2;
        }

        if ($shoulders - $buttocks >= 6) {
            return 1;
        }

        return 3;
    };

    return factory;
}]);