Unica.controller('SearchController', ['$scope', '$http', function($scope, $http) {

    $scope.searchText = '';

    $scope.simulateQuery = false;
    $scope.isDisabled    = false;
    $scope.querySearch   = querySearch;
    $scope.selectedItemChange = selectedItemChange;
    
    function querySearch (query) {
        return $http.post('/customer/search?include=images', {
            query: $scope.searchText
        }).then(function(response) {
            return response.data.data;
        });
    }

    function selectedItemChange(item) {
        location.href = '/customer/' + item.id;
    }

}]);
