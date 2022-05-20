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
    };

    function toString(response) {
        return response.data.message;
    }

    function authData() {
        return {
            headers: {
                "X-TOKEN-ID": aiStorage.get('unica_token', Unica.STORAGE)
            }
        };
    }

    factory.submitQuiz = function (data) {
        return $http.post(location.href, data, authData()).then(toData);
    };

    factory.placeOrder = function (orderData) {
        return $http.post('/customer/checkout', orderData, authData()).then(toData);
    };

    factory.cancelOrder = function (orderId) {
        return $http.get('/customer/order/' + orderId + '/cancel', authData()).then(toData);
    };

    factory.requestToken = function (email) {
        return $http.post('/auth/token', {email: email}).then(toString);
    };

    factory.confirmToken = function (email, token) {
        return $http.post('/auth/confirm', {email: email, token: token}).then(toString);
    };

    factory.register = function (data) {
        return $http.post('/auth/register', data).then(toString);
    };

    return factory;
}]);
