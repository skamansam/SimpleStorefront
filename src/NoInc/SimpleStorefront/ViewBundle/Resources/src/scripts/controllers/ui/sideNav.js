app.controller('sideNavController', ($scope, $mdSidenav) => {
    $scope.close = () => {
        $mdSidenav('left').close();
    };
});
