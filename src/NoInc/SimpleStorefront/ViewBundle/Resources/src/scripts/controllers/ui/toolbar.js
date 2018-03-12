app.controller('toolbarController', ($scope, $mdSidenav) => {
    $scope.closeSideNav = () => {
        $mdSidenav('left').close();
    };
    $scope.openSideNav = () => {
        $mdSidenav('left').open();
    };
    $scope.toggleSideNav = () => {
        console.info('toggle nav');
        $mdSidenav('left').toggle();
    };
});
