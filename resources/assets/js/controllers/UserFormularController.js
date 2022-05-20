Unica.controller('UserFormularController', ['$scope', 'System', 'aiStorage', 'FigureType', 'PressureType', '$mdDialog', '$mdBottomSheet', function ($scope, System, aiStorage, FigureType, PressureType, $mdDialog, $mdBottomSheet) {

    function validateUser() {
        if (! aiStorage.get('unica_token', Unica.STORAGE)) {
            clearReloadAlert();
            location.href = '/customer/signup';
            return false;
        }
    }

    validateUser();

    function clearReloadAlert()
    {
        window.onbeforeunload = null;
    }

    var $validator = setInterval(validateUser, 60000);

    $scope.isStepValid = isStepValid;
    $scope.setForm = setForm;
    $scope.finish = finish;
    $scope.placeOrder = placeOrder;
    $scope.cancelOrder = cancelOrder;
    $scope.constitutionImage = constitutionImage;
    $scope.requireLoadPressure = requireLoadPressure;

    $scope.currentSlide = 0;

    var history = {
        get: function () {
            return $scope.data;
        },
        merge: function (history) {
            $scope.data = angular.extend($scope.data, history || {});
        },
        checkout: {
            offer: function () {
                return $scope.payment.offer;
            },
            gateway: function () {
                return $scope.payment.gateway
            }
        }
    };

    /**
     * Initial data, listings
     * @type {{}}
     */
    $scope.lists = {};

    /**
     * All forms
     * @type {{setup: {}, record: {}, cardio: {}, schedule: {}, diseases: {}, nutrition: {}, checkout: {}}}
     */
    $scope.forms = {
        setup: {},
        record: {},
        cardio: {},
        schedule: {},
        diseases: {},
        nutrition: {},
        checkout: {},
        order: {}
    };

    /**
     * Payment info
     * @type {{}}
     */
    $scope.payment = {
        gateway: 'qiwi'
    };

    /**
     * Main form data
     * @type {{}}
     */
    $scope.data = {
        /* Default schedule */
        schedule: {
            "mon": {"type": "rest"},
            "tue": {"type": "rest"},
            "fri": {"type": "rest"},
            "thu": {"type": "rest"},
            "wen": {"type": "rest"},
            "sat": {"type": "rest"},
            "sun": {"type": "discharging"}
        }
    };

    /**
     * Num of selected days with workout
     * @type {number}
     */
    $scope.workoutDays = 0;
    $scope.restDays = 0;
    $scope.dischargingDays = 0;
    $scope.selectedDays = 0;


    $scope.$watch('data.pressure_rest.max', detectPressureReaction);
    $scope.$watch('data.pressure_load.max', detectPressureReaction);
    function detectPressureReaction() {
        var data = history.get();

        if (!(data.pressure_rest && data.pressure_rest.max)) {
            history.merge({
                pressure_type_id: null
            });
        } else {
            var rest = parseInt(data.pressure_rest.max);
            if (rest >= 140) {
                history.merge({
                    pressure_type_id: PressureType.detect(rest, null)
                });
            } else if (rest && data.hasOwnProperty('pressure_load') && data.pressure_load.max) {
                var load = data.pressure_load.max;
                history.merge({
                    pressure_type_id: PressureType.detect(rest, load)
                });
            } else {
                history.merge({
                    pressure_type_id: null
                });
            }
        }
    }

    $scope.$watch('data', persistForm, true);
    $scope.$watch('payment', persistPayment, true);

    $scope.$watch('data.shoulders', function () {
        detectFigureType(history.get().shoulders, history.get().buttocks);
    });
    $scope.$watch('data.buttocks', function () {
        detectFigureType(history.get().shoulders, history.get().buttocks);
    });
    function detectFigureType(shoulders, buttocks) {
        history.merge({
            figure_type_id: FigureType.detect(buttocks, shoulders)
        });
    }

    $scope.$watch('data.schedule', function () {
        var data = history.get();

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
     * Restore forms data on page reloading
     */
    (function restoreForm() {
        history.merge(aiStorage.get('unica_value', Unica.STORAGE) || {});
    })();

    (function restorePayment() {
        $scope.payment = angular.extend($scope.payment, (aiStorage.get('unica_payment', Unica.STORAGE) || {}));
    })();

    /**
     * Save form data to the localStorage
     */
    function persistForm() {
        aiStorage.set('unica_value', $scope.data, Unica.STORAGE);
    }

    function persistPayment() {
        aiStorage.set('unica_payment', $scope.payment, Unica.STORAGE);
    }

    function forms() {
        return Object.keys($scope.forms);
    }

    function setForm(form) {
        if (form) {
            aiStorage.set('unica_form', form, Unica.STORAGE);
        } else if (!aiStorage.get('unica_form', Unica.STORAGE)) {
            aiStorage.set('unica_form', forms()[0], Unica.STORAGE);
        }

        $scope.currentSlide = forms().indexOf(aiStorage.get('unica_form', Unica.STORAGE));
        $scope.currentForm = forms()[$scope.currentSlide];

        angular.trackPage('/customer/health-testing/' + $scope.currentForm, 'Regim Alimentar - ' + $scope.currentForm);
    }

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

    $scope.highRestPressure = function () {
        return $scope.data.hasOwnProperty('pressure_rest')
            && $scope.data.pressure_rest['max'] > 130;
    };

    $scope.highLoadPressure = function () {
        return $scope.data.hasOwnProperty('pressure_load')
            && $scope.data.pressure_load['max'] > 130;
    };

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

    function alertServerError(response) {
        $scope.submitting = false;

        if (422 == response.status) {
            var msgs = '', field;
            for (field in response.data) {
                if (response.data.hasOwnProperty(field)) {
                    msgs += field.toUpperCase() + ': ' + response.data[field].join("\n");
                }
            }

            alert(msgs);
        }
    }

    $scope.submitting = false;

    function finish() {
        $scope.submitting = true;

        return System
            .submitQuiz($scope.data)
            .then(function (response) {
                $scope.submitting = false;

                if (response && response.id) {
                    history.merge(response);

                    $scope.slideNext();
                }
            }).catch(alertServerError);
    }

    function placeOrder() {
        $scope.submitting = true;

        var orderData = {
            history: history.get().id,
            offer: history.checkout.offer(),
            gateway: history.checkout.gateway()
        };

        System.placeOrder(orderData).then(function (response) {
            $scope.submitting = false;

            if (response && response.id) {
                $scope.payment.order = response;

                $scope.slideNext();

                aiStorage.set('unica_form', 'setup', Unica.STORAGE);
                aiStorage.remove('unica_value', Unica.STORAGE);
                aiStorage.remove('unica_token', Unica.STORAGE);
                aiStorage.remove('unica_payment', Unica.STORAGE);

                clearInterval($validator);

                clearReloadAlert();
            }
        }).catch(alertServerError);
    }

    function cancelOrder(ev) {
        function showBottomShit(ev, callback) {
            $mdBottomSheet.show({
                templateUrl: 'cancel-order.html',
                controller: ['$scope', '$mdBottomSheet', function ($scope, $mdBottomSheet) {
                    $scope.closeSheet = function () {
                        $mdBottomSheet.hide();
                    };

                    $scope.confirm = callback;
                }],
                targetEvent: ev
            });
        }

        showBottomShit(ev, requestCancellation);

        function requestCancellation() {
            return System.cancelOrder($scope.payment.order.id).then(function () {
                delete $scope.payment.order;

                $mdBottomSheet.hide();
                $scope.slidePrev();
            }).catch(alertServerError);
        }
    }

    /**
     * Check if rest pressure is normal
     * @returns {boolean}
     */
    function requireLoadPressure() {
        if ($scope.highRestPressure()) {
            return false;
        }

        var hasLoadPressure = history.get().hasOwnProperty('pressure_load');
        if (hasLoadPressure && parseInt(history.get().pressure_load.max) && parseInt(history.get().pressure_load.min)) {
            return false;
        }

        var hasRestPressure = history.get().hasOwnProperty('pressure_rest');

        return (hasRestPressure && parseInt(history.get().pressure_rest.max) < 140);
    }

    function measurementImagePath(measurement) {
        return "/images/measurements/" + measurement + '.jpg';
    }

    $scope.setMeasurementImage = function (measurement) {
        $scope.measurementImage = measurementImagePath(measurement);
    };

    $scope.showMeasurementImagePopup = function (ev, measurement) {
        var image = measurementImagePath(measurement);

        $mdDialog.show({
            clickOutsideToClose: true,
            scope: $scope,
            preserveScope: true,
            template: '' +
            '<md-dialog>' +
            '  <md-dialog-content layout="column">' +
            '     <img src="' + image + '?' + ((new Date).getTime()) + '" />' +
            '     <md-button class="md-raised" ng-click="closeDialog()">Ok</md-button>' +
            '  </md-dialog-content>' +
            '</md-dialog>',
            controller: function DialogController($scope, $mdDialog) {
                $scope.closeDialog = function () {
                    $mdDialog.hide();
                }
            }
        });
    };

    $scope.offerPrice = function () {
        if (!$scope.payment.offer) {
            return '-';
        }

        return $scope.lists.offers.filter(function (item) {
                return parseInt(item.id) == parseInt($scope.payment.offer);
            })[0].price;
    };

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