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