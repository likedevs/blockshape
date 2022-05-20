Unica.controller('NavigationController', ['$scope', '$mdSidenav', '$mdUtil', '$mdMedia', function($scope,  $mdSidenav, $mdUtil, $mdMedia) {

    $scope.toggleLeft = buildToggler('left');


    $scope.$watch(function() { return [$mdMedia('sm'), $mdMedia('md'), $mdMedia('lg')] }, function(big) {
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
