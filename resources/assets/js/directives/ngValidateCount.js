Unica.directive('ngValidateCount', function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, element, attribs, ngModel) {
            var minCount = parseInt(attribs.ngValidateCount);

            function eq(value, minCount) {
                return (parseInt(value) === minCount);
            }

            //For DOM -> model validation
            function setValidity(value) {
                ngModel.$setValidity('minCount', eq(value, minCount));
            }

            ngModel.$parsers.unshift(function (value) {
                setValidity(value);
                return value ? value : undefined;
            });

            ngModel.$formatters.unshift(function (value) {
                setValidity(value);
                return value;
            });
        }
    }
})
