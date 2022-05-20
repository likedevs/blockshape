Unica.controller('FormularController', ['$scope', 'System', 'aiStorage', 'FigureType', 'PressureType', function ($scope, System, aiStorage, FigureType, PressureType) {

    $scope.isStepValid = isStepValid;
    $scope.setForm = setForm;
    $scope.finish = finish;
    $scope.setDepartment = setDepartment;
    $scope.constitutionImage = constitutionImage;
    $scope.requireLoadPressure = requireLoadPressure;

    $scope.lists = {};

    $scope.currentSlide = 0;

    // department form
    $scope.forms = {
        department: {},
        setup: {},
        record: {},
        cardio: {},
        schedule: {},
        diseases: {},
        nutrition: {}
    };

    $scope.data = {};

    $scope.workoutDays = 0;
    $scope.restDays = 0;
    $scope.dischargingDays = 0;
    $scope.selectedDays = 0;

    $scope.$watch('data', function (data, dataOld) {
        persistForm();

        // detect figure type
        if (data.hasOwnProperty('shoulders')
            && data.hasOwnProperty('buttocks')
            && (data.shoulders != dataOld.shoulders || data.buttocks != dataOld.buttocks))
        {
            $scope.data.figure_type_id = FigureType.detect(data.buttocks, data.shoulders);
        }

        // detect pressure reaction
        if (data.hasOwnProperty('pressure_rest')) {
            var before = data.pressure_rest.max, beforeOld = dataOld.pressure_rest ? dataOld.pressure_rest.max : null;
            var after = null, afterOld = dataOld.pressure_load ? dataOld.pressure_load.max : null;
            if (data.hasOwnProperty('pressure_load')) {
                after = data.pressure_load.max;
            }

            var cond1 = before && before != beforeOld && before >= 140;
            var cond2 = before && after && (after != afterOld || before != beforeOld);
            if (cond1 || cond2) {
                //console.log('detect', cond1, cond2);
                $scope.data.pressure_type_id = PressureType.detect(before, after);
            }
        }

        if (data.hasOwnProperty('schedule')) {
            var workoutDays = 0;
            var restDays = 0;
            var dischargingDays = 0;

            for (var day in data.schedule) {
                var options = data.schedule[day];

                switch (options.type) {
                    case 'activity':
                        workoutDays++;
                        break;

                    case 'rest':
                        restDays++;
                        break;

                    case 'discharging':
                        dischargingDays++;
                        break;
                }

            }

            $scope.workoutDays = workoutDays;
            $scope.restDays = restDays;
            $scope.dischargingDays = dischargingDays;
            $scope.selectedDays = (workoutDays + restDays + dischargingDays);
        }
    }, true);

    $scope.$on('Schedule::updatedDay', function (event, options) {
        if (!$scope.data.hasOwnProperty('schedule')) {
            $scope.data.schedule = {};
        }

        // since only one discharging day is allowed
        // reset previous selected discharging days
        var day = options[0];
        options = options[1];

        if (options[day]['type'] == 'discharging') {
            for (var _day in $scope.data.schedule) {
                if (_day != day && $scope.data.schedule.hasOwnProperty(_day) && $scope.data.schedule[_day]['type'] == 'discharging') {
                    $scope.data.schedule[_day]['type'] = 'rest';
                    $scope.$broadcast('Schedule::resetDay', _day);
                }
            }
        }

        angular.extend($scope.data.schedule, options || {});
    });

    /**
     * Restore form data on page reloading
     */
    (function restoreForm() {
        $scope.data = (aiStorage.get('unica_value', Unica.STORAGE) || {});
    })();

    /**
     * Save form data to the localStorage
     */
    function persistForm() {
        aiStorage.set('unica_value', $scope.data, Unica.STORAGE);
    }

    function allForms() {
        return Object.keys($scope.forms);
    }

    function setForm(form) {
        if (form) {
            aiStorage.set('unica_form', form, Unica.STORAGE);
        } else if (!aiStorage.get('unica_form', Unica.STORAGE)) {
            aiStorage.set('unica_form', allForms()[0], Unica.STORAGE);
        }
        $scope.currentSlide = allForms().indexOf(aiStorage.get('unica_form', Unica.STORAGE));
        $scope.currentForm = allForms()[$scope.currentSlide];
    };
    setForm();

    /**
     * When accessing a property from data object => ensure that property exists
     * @param list
     * @returns {*}
     */
    function checkDataExistence(list) {
        if (!$scope.data.hasOwnProperty(list)) {
            $scope.data[list] = [];
        }

        return $scope.data[list];
    }

    /**
     * Toggle item existence in a list
     * @param item
     * @param list
     */
    $scope.toggle = function (item, list) {
        var data = checkDataExistence(list);

        var idx = data.indexOf(item);
        if (idx > -1)
            data.splice(idx, 1);
        else
            data.push(item);
    };

    /**
     * Check item existence in a list
     *
     * @param item
     * @param list
     * @returns {boolean}
     */
    $scope.exists = function (item, list) {
        var data = checkDataExistence(list);

        return data.indexOf(item) > -1;
    };

    /**
     * Check if current form is valid
     * and Instructor can go to the next page
     */
    function isStepValid(form) {
        if (form) {
            return $scope.forms[form].$valid;
        }
        return $scope.forms[$scope.currentForm].$valid;
    }

    /**
     * Set fillial [office]
     */
    function setDepartment(dep) {
        angular.extend($scope.data, {
            office_id: parseInt(dep.id)
        });
    }

    /**
     * Get Constitution type image
     *
     * @returns {*}
     */
    function constitutionImage() {
        var $typeId = parseInt($scope.data.figure_type_id),
            $list = $scope.lists.figureTypes;

        if (!($typeId && $list.length)) {
            return '';
        }

        for (var $i in $list) {
            if (parseInt($list[$i].id) == $typeId)
                return $list[$i].image;
        }

        return '';
    }

    $scope.submitting = false;
    function finish() {
        $scope.submitting = true;
        return System
            .submitQuiz($scope.data)
            .then(function (response) {
                $scope.submitting = false;
                // clean local storage
                aiStorage.set('unica_value', {}, Unica.STORAGE);
                aiStorage.set('unica_form', 'department', Unica.STORAGE);

                // redirect to user's profile page
                if (response.hasOwnProperty('user_id')) {
                    window.onbeforeunload = null;
                    location.href = '/customer/' + response.user_id;
                }
            }).catch(function (response) {
                $scope.submitting = false;

                if (422 == response.status) {
                    var msgs = '';
                    for (var field in response.data) {
                        msgs += field.toUpperCase() + ': ' + response.data[field].join("\n");
                    }

                    alert(msgs);
                }
            });
    }

    /**
     * Check if rest pressure is normal
     * @returns {boolean}
     */
    function requireLoadPressure()
    {
        var hasRestPressure = $scope.data.hasOwnProperty('pressure_rest');

        return ! hasRestPressure || (hasRestPressure && parseInt($scope.data.pressure_rest.max) < 140);
    }

    $scope.slideNext = function () {
        $scope.currentSlide += 1;

        setForm(forms()[$scope.currentSlide]);
    };

    $scope.slidePrev = function () {
        if ($scope.currentSlide >= 1) {
            $scope.currentSlide -= 1;

            setForm(forms()[$scope.currentSlide]);
        }
    }
}]);
