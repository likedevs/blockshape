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
