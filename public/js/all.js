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
    $mdThemingProvider.theme('default')
        .primaryPalette('pink')
        .accentPalette('orange');

    // $mdThemingProvider.theme('default').foregroundPalette[3] = 'rgba(0,0,0,0.76)';
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
var templates = angular.module('templates', []);
templates.run(['$templateCache', function ($templateCache) {
    $templateCache.put('cancel-order.html',
        '<md-bottom-sheet class="md-list md-has-header" ng-cloak>' +
        '   <md-subheader>Anulare comandă</md-subheader>' +
        '   <md-list>' +
        '       <md-list-item>' +
        '           <md-button flex ng-click="closeSheet()" class="md-list-item-content md-raised md-default">' +
        '               <md-icon>check</md-icon>' +
        '               Vreau să continui' +
        '           </md-button>' +
        '       </md-list-item>' +
        '       <md-list-item>' +
        '           <md-button flex ng-click="confirm()" class="md-list-item-content md-raised md-warn">' +
        '               <md-icon>close</md-icon>' +
        '               Vreau să anulez' +
        '           </md-button>' +
        '       </md-list-item>' +
        '       <md-list-item>&nbsp;</md-list-item>' +
        '   </md-list>' +
        '</md-bottom-sheet>'
    );

    $templateCache.put('schedule-day.html',
        '<div layout-padding>' +
        '   <div layout="column">' +
        '       <div layout="row" layout-align="start start" layout-padding>' +
        '           <h3 class="md-title" style="margin-top: 6px;" ng-class="{\'required\': ! isValid()}">{{ weekday }}:</h3>' +
        '           <md-select flex="10" placeholder="{{ hour }}" style="margin: 0 10px;" ng-required="isActivityDay()" class="md-mini" ng-show="isActivityDay()" ng-model="time" aria-label="Workout time">' +
        '               <md-option ng-value="ts" ng-repeat="ts in workouts">{{ ts }}</md-option>' +
        '           </md-select>' +
        '           <span flex></span>' +
        '       </div>' +
        '       <div layout="row">' +
        '           <md-button aria-label="Zi de antrenament" ng-click="setType(\'activity\')" class="md-flat" ng-class="{\' md-primary\': isActivityDay(), \'btn-left\': largeDevice}">' +
        '               <md-icon>directions_run</md-icon> Zi de antrenament' +
        '           </md-button>' +
        '           <md-button aria-label="Zi de odihna" ng-click="setType(\'rest\')" class="md-flat" ng-class="{\'md-primary\': isRestDay(), \'btn-middle\': largeDevice}">' +
        '               <md-icon>restore</md-icon> Zi fără antrenament' +
        '           </md-button>' +
        '           <md-button aria-label="Zi de detoxifiere" ng-click="setType(\'discharging\')" class="md-flat" ng-class="{\'md-primary\': isDetoxDay(), \'btn-right\': largeDevice}">' +
        '               <md-icon>radio_button_unchecked</md-icon> Zi de detoxifiere' +
        '           </md-button>' +
        '       </div>' +
        '   </div>' +
        '   <md-divider></md-divider>' +
        '</div>'
    );
}]);

Unica.factory('FigureType', [function() {
    var factory = {};

    factory.detect = function($buttocks, $shoulders) {
        $buttocks = parseInt($buttocks);
        $shoulders = parseInt($shoulders);
        if (! ($buttocks && $shoulders)) {
            return null;
        }

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
Unica.factory('System', ['$timeout', '$http', 'aiStorage', function ($timeout, $http, aiStorage) {
    var factory = {};

    /**
     * Fetch data from response
     *
     * @param response
     * @returns {*}
     */
    function toData(response) {
        return response.data.data;
    }

    function toString(response) {
        return response.data.message;
    }

    function authData() {
        return {
            //
        };
    }

    factory.submitQuiz = function (data) {
        return $http.post(location.href, data, authData()).then(toData);
    };

    factory.placeOrder = function (orderData) {
        return $http.post('/checkout', orderData, authData()).then(toData);
    };

    factory.cancelOrder = function (orderId) {
        return $http.get('/order/' + orderId + '/cancel', authData()).then(toData);
    };

    factory.register = function (data) {
        return $http.post('/auth/register', data).then(toString);
    };

    return factory;
}]);

Unica.factory('TNF', function () {
    var factory = {};

    factory.forms = function () {
        return window['tnf_steps'];
    };

    return factory;
});

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
            && (data.shoulders != dataOld.shoulders || data.buttocks != dataOld.buttocks)) {
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
        console.log('vcsdf');
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
                if (response.hasOwnProperty('user')) {
                    window.onbeforeunload = null;
                    location.href = laroute.route('instructor.customer.show', {'customer': response.user.data.id});
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
    function requireLoadPressure() {
        var hasRestPressure = $scope.data.hasOwnProperty('pressure_rest');

        return !hasRestPressure || (hasRestPressure && parseInt($scope.data.pressure_rest.max) < 140);
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

Unica.controller('HistoryController', ['$scope', '$timeout', '$mdDialog', function ($scope, $timeout, $mdDialog) {
    $scope.records = {};
    $scope.pending = statusPending;
    $scope.confirmed = statusConfirmed;
    $scope.declined = statusDeclined;

    $scope.key = '';
    $scope.channel = '';

    function textConfirmed(data) {
        return 'Document for ' + data.user + ' has been confirmed';
    }

    function textDeclined(data) {
        return 'Document for ' + data.user + ' has been declined' + (data.hasOwnProperty('reason') ? (": \n" + data.reason) : '');
    }

    function translateDay(day) {
        return {
            'mon' : 'Luni',
            'tue' : 'Marti',
            'wen' : 'Miercuri',
            'thu' : 'Joi',
            'fri' : 'Vineri',
            'sat' : 'Simbata',
            'sun' : 'Duminica'
        }[day];
    }

    function days() {
        return ['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun'];
    }

    $scope.showRecordSchedule = function ($event, schedule) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
            parent: parentEl,
            targetEvent: $event,
            template:
            '<md-dialog aria-label="List dialog">' +
            '  <md-dialog-content>'+
            '      <table class="table">'+
            '       <tr ng-repeat="day in days">' +
            '           <td><strong>{{ translateDay(day) }}:</strong></td>' +
            '           <td>' +
            '               <div ng-if="schedule[day].type == \'activity\'">Ze de antrenament (<strong>{{ schedule[day].time }}</strong>)</div>' +
            '               <div ng-if="schedule[day].type == \'rest\'">Ze fara antrenament</div>' +
            '               <div ng-if="schedule[day].type == \'discharging\'">Ze de detox</div>' +
            '           </td>' +
            '       </tr>' +
            '      </table>' +
            '  </md-dialog-content>' +
            '  <md-dialog-actions>' +
            '    <md-button ng-click="closeDialog()" class="md-primary">' +
            '      Inchide' +
            '    </md-button>' +
            '  </md-dialog-actions>' +
            '</md-dialog>',
            locals: {
                schedule: schedule,
                days: days()
            },
            controller: function DialogController($scope, $mdDialog, schedule, days) {
                $scope.schedule = schedule;
                $scope.days = days;

                $scope.closeDialog = function() {
                    $mdDialog.hide();
                };

                $scope.translateDay = translateDay;
            }
        });
    };

    $scope.showRecordAnswers = function ($event, answers) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
            parent: parentEl,
            targetEvent: $event,
            template:
            '<md-dialog aria-label="List dialog">' +
            '  <md-dialog-content>'+
            '    <md-list>' +
            '      <ul class="list-unstyled">'+
            '       <li ng-repeat="question in answers">' +
            '           <strong>{{ question.question.question }}:</strong><br />' +
            '           <em>&raquo;&nbsp;{{ question.answer.answer }}</em>' +
            '       </li>' +
            '       </ul>' +
            '      </table>' +
            '    </md-list>'+
            '  </md-dialog-content>' +
            '  <md-dialog-actions>' +
            '    <md-button ng-click="closeDialog()" class="md-primary">' +
            '      Inchide' +
            '    </md-button>' +
            '  </md-dialog-actions>' +
            '</md-dialog>',
            locals: {
                answers: answers
            },
            controller: function DialogController($scope, $mdDialog, answers) {
                $scope.answers = answers;

                $scope.closeDialog = function() {
                    $mdDialog.hide();
                };
            }
        });
    };

    $scope.openDialog = function (data) {
        var alert = $mdDialog.alert({
            title: ('confirmed' == data.status ? 'Confirmed' : 'Declined'),
            content: ('confirmed' == data.status ? textConfirmed(data) : textDeclined(data)),
            ok: 'Close'
        });
        $mdDialog
            .show(alert)
            .finally(function () {
                alert = undefined;
            });
    };

    $timeout(function () {
        var pusher = new Pusher($scope.key, {
            encrypted: true
        });
        var channel = pusher.subscribe($scope.channel);
        channel.bind('DocumentProcessed', function (data) {
            if (data && data.record) {
                var id = data.record;

                angular.safeApply($scope, function ($scope) {
                    $scope.records[id].status = data.status;
                });

                $scope.openDialog(data);
            }
        });
    });

    function statusPending(id) {
        return $scope.records[id].status == 'pending';
    }

    function statusDeclined(id) {
        return $scope.records[id].status == 'declined';
    }

    function statusConfirmed(id) {
        return $scope.records[id].status == 'confirmed';
    }
}]);
Unica.controller('NavigationController', ['$scope', '$mdSidenav', '$mdUtil', '$mdMedia', function($scope,  $mdSidenav, $mdUtil, $mdMedia) {

    $scope.toggleLeft = buildToggler('left');

    $scope.$watch(function() { return [$mdMedia('sm'), $mdMedia('md'), $mdMedia('lg')] }, function() {
        $scope.isSmall = $mdMedia('sm');
        $scope.isMedium = $mdMedia('md');
        $scope.isLarge = $mdMedia('lg') || $mdMedia('gt-lg');
    }, true);

    /**
     * Build handler to open/close a SideNav; when animation finishes
     * report completion in console
     */
    function buildToggler(navID) {
      var debounceFn =  $mdUtil.debounce(function(){
            $mdSidenav(navID).toggle();
          },300);
      return debounceFn;
    }
}]);

Unica.controller('SearchController', ['$scope', '$http', function($scope, $http) {

    $scope.searchText = '';

    $scope.simulateQuery = false;
    $scope.isDisabled    = false;
    $scope.querySearch   = querySearch;
    $scope.selectedItemChange = selectedItemChange;

    function querySearch (query) {
        return $http.post('/instructor/customer/search?include=images', {
            query: $scope.searchText
        }).then(function(response) {
            return response.data.data;
        });
    }

    function selectedItemChange(item) {
        location.href = '/instructor/customer/' + item.id;
    }

}]);

Unica.controller('UserFormularController', ['$scope', 'System', 'aiStorage', 'FigureType', 'PressureType', 'TNF', '$mdDialog', '$mdBottomSheet', function ($scope, System, aiStorage, FigureType, PressureType, TNF, $mdDialog, $mdBottomSheet) {
    function clearReloadAlert() {
        window.onbeforeunload = null;
    }

    $scope.isStepValid = isStepValid;
    $scope.setForm = setForm;
    $scope.finish = finish;
    $scope.constitutionImage = constitutionImage;
    $scope.requireLoadPressure = requireLoadPressure;

    $scope.currentSlide = 0;

    var history = {
        get: function () {
            return $scope.data;
        },
        merge: function (history) {
            $scope.data = angular.extend($scope.data, history || {});
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
    $scope.forms = TNF.forms();

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

    /**
     * Save form data to the localStorage
     */
    function persistForm() {
        aiStorage.set('unica_value', $scope.data, Unica.STORAGE);
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

        if (-1 == $scope.currentSlide) {
            $scope.currentSlide = 0;
        }

        $scope.currentForm = forms()[$scope.currentSlide];

        angular.trackPage('/health-testing/' + $scope.currentForm, 'Regim Alimentar - ' + $scope.currentForm);

        setTimeout(function () {
            location.href = '#top';
        }, 750);
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
                // $scope.submitting = false;

                if (response && response.id) {
                    // history.merge(response);
                    // $scope.slideNext();

                    aiStorage.set('unica_form', 'setup', Unica.STORAGE);
                    aiStorage.remove('unica_value', Unica.STORAGE);

                    clearReloadAlert();

                    location.href = laroute.route('user.record.sent');
                }
            }).catch(alertServerError);
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
Unica.directive('ngScheduleDay', ['$templateCache', '$mdMedia', function ($templateCache, $mdMedia) {
    return {
        restrict: "E",
        replace: true,
        scope: {
            day: "@",
            weekday: "@",
            num: "@",
            load: "@",
            rest: "@",
            discharging: "@",
            hour: "@"
        },
        link: function (scope) {
            scope.media = $mdMedia;

            var schedule = scope.$parent.data.schedule;
            scope.type = schedule && schedule[scope.day] && schedule[scope.day].type ? schedule[scope.day].type : null;
            scope.time = schedule && schedule[scope.day] && schedule[scope.day].time ? schedule[scope.day].time : null;

            scope.isValid = function () {
                if (!scope.type) {
                    return false;
                } else if (scope.isActivityDay() && !scope.time) {
                    return false;
                }
                return true;
            };

            /**
             * Workouts time
             */
            scope.workouts = [
                '07:00', '07:30',
                '08:00', '08:30',
                '09:00', '09:30',
                '10:00', '10:30',
                '11:00', '11:30',
                '12:00', '12:30',
                '13:00', '13:30',
                '14:00', '14:30',
                '15:00', '15:30',
                '16:00', '16:30',
                '17:00', '17:30',
                '18:00', '18:30',
                '19:00', '19:30',
                '20:00', '20:30'
            ];

            function getObject() {
                var obj = {};
                obj[scope.day] = {
                    type: scope.type
                };
                if (scope.isActivityDay()) {
                    angular.extend(obj[scope.day], {
                        time: scope.time
                    });
                }

                return obj;
            }

            scope.setType = function (activity) {
                scope.type = activity;

                scope.$emit('Schedule::updatedDay', [scope.day, getObject()]);
            };

            scope.largeDevice = $mdMedia('min-width: 600px');

            scope.isDetoxDay = function () {
                return 'discharging' == scope.type;
            };

            scope.isActivityDay = function () {
                return 'activity' == scope.type;
            };

            scope.isRestDay = function () {
                return 'rest' == scope.type;
            };

            scope.$watch('time', function (v1, v2) {
                if (v1 !== v2) {
                    scope.$emit('Schedule::updatedDay', [scope.day, getObject()]);
                }
            });

            scope.$on('Schedule::resetDay', function ($event, day) {
                // reset day type to rest
                if (day == scope.day) {
                    scope.setType('rest');
                }
            })
        },
        template: $templateCache.get('schedule-day.html')
    }
}]);

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

//# sourceMappingURL=all.js.map
