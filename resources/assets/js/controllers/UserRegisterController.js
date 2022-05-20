Unica.controller('UserRegisterController', ['$scope', '$mdDialog', 'System', 'aiStorage', '$timeout', function ($scope, $mdDialog, System, aiStorage, $timeout) {

    aiStorage.set('unica_form', 'setup', Unica.STORAGE);
    aiStorage.remove('unica_token', Unica.STORAGE);
    aiStorage.remove('unica_payment', Unica.STORAGE);
    aiStorage.remove('unica_value', Unica.STORAGE);

    $scope.data = {
        genders: []
    };

    $scope.user = {
        gender: 'female'
    };

    $scope.errors = {};

    $scope.submitting = false;

    // user email confirmation status
    $scope.email = {
        user: null,
        token: null,
        requested: false,
        confirmed: false
    };

    $scope.setGender = function (gender) {
        if (gender.disabled) {
            showAlert('Atenție', gender.message, 'Am înțeles!');
        } else {
            $scope.user.gender = gender.value;
        }
    };

    $scope.requestToken = function () {
        angular.trackPage('/customer/signup/token-request', 'Regim Alimentar - Send validation code');

        $scope.submitting = true;

        System.requestToken($scope.user.email).then(function (response) {
            if ('ok' == response) {
                $scope.email.requested = true;
            }

            $scope.submitting = false;
        });
    };

    function persistUser(response) {
        if (response.user) {
            $scope.email.user = response.user;
        }

        if (response.token) {
            aiStorage.set('unica_token', response.token, Unica.STORAGE);
        }
    }

    $scope.confirmToken = function () {
        // angular.trackPage('/customer/signup/token-confirm');

        $scope.submitting = true;
        System.confirmToken($scope.user.email, $scope.email.token).then(function (response) {
            if (response.confirmed) {
                angular.trackPage('/customer/signup/token-confirmed', 'Regim Alimentar - Token confirmed');

                $scope.email.confirmed = true;
            }

            persistUser(response);
            $scope.submitting = false;
        }).catch(function (response) {
            showAlert('Atenție', response.data.description.message, 'Închide');
            $scope.submitting = false;
        });
    };

    $scope.goToFormular = function () {
        location.href = $scope.email.user.form_url;
    };

    $scope.register = function () {
        angular.trackPage('/customer/signup/register', 'Regim Alimentar - Inregistrare');

        $scope.errors = {};

        $scope.submitting = true;

        System.register($scope.user).then(function (response) {
            persistUser(response);

            $scope.submitting = false;

            if (response.user) {
                location.href = response.user.form_url;
            }
        }).catch(function (response) {
            if (response.hasOwnProperty('data') && angular.isObject(response.data)) {
                $scope.errors = response.data;
            }

            $scope.submitting = false;
        });
    };

    var showAlert = function(title, message, okButton) {
        // Appending dialog to document.body to cover sidenav in docs app
        // Modal dialogs should fully cover application
        // to prevent interaction outside of dialog
        $mdDialog.show(
            $mdDialog.alert()
                //.parent(angular.element('body'))
                .clickOutsideToClose(true)
                .title(title)
                .content(message)
                .ariaLabel(title)
                .ok(okButton)
        );
    };

    $scope.currentSlide = 0;

    $scope.slideNext = function () {
        $scope.currentSlide += 1;

        switch ($scope.currentSlide) {
            case 1:
                return angular.trackPage('/customer/signup/email-request', 'Regim Alimentar - Request email');

            case 2:
                return angular.trackPage('/customer/signup/registration', 'Regim Alimentar - Registration info');
        }
    };

    $scope.slidePrev = function () {
        if ($scope.currentSlide > 1) {
            $scope.currentSlide -= 1;
        }
    }
}]);
