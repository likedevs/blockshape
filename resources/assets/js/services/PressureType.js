Unica.factory('PressureType', [function () {
    var R_NORMOTONIE = 'normotonie';
    var R_HIPOTONIE = 'hipotonie';
    var R_HIPERTONIE = 'hipertonie';
    var R_ATTENTION = 'attention';

    var factory = {};

    factory.detect = function ($before, $after) {
        if ($before >= 140) {
            return this.id(R_HIPERTONIE + '-' + R_ATTENTION);
        } else {
            $before = this.detectBeforeValue($before);

            $after = this.detectAfterValue($after);

            return this.id($before + '-' + $after);
        }
    };

    /**
     * @param $before
     * @return string
     */
    factory.detectBeforeValue = function($before)
    {
        if ($before < 110) {
            return R_HIPOTONIE;
        }

        return R_NORMOTONIE;
    };

    /**
     * @param $after
     * @return string
     */
    factory.detectAfterValue = function($after)
    {
        if ($after <= 130) {
            return R_NORMOTONIE;
        }

        return R_HIPERTONIE;
    };

    factory.id = function($value) {
        var $map = {
            1 : (R_NORMOTONIE + '-' + R_NORMOTONIE),
            2 : (R_HIPOTONIE + '-' + R_NORMOTONIE),
            3 : (R_HIPOTONIE + '-' + R_HIPERTONIE),
            4 : (R_HIPERTONIE + '-' + R_ATTENTION),
            5 : (R_NORMOTONIE + '-' + R_HIPERTONIE)
        };

        for (var $id in $map) {
            if ($map[$id] == $value) {
                return $id;
            }
        }

        console.log("Can not resolve: " + $value);
        return null;
    };

    return factory;
}]);