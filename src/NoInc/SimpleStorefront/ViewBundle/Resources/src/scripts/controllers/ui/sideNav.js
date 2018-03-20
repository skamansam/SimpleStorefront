app.controller('sideNavController', ($scope, $state, $mdSidenav, $timeout, countsProvider, userProvider) => {
    $scope.recipeCount = 0;
    $scope.ingredientCount = 0;
    $scope.userCount = 0;
    $scope.productCount = 0;
    $scope.user = {};

    $scope.close = () => {
        $mdSidenav('left').close();
    };

    $scope.$on('userChanged', () => {
        $scope.getUser();
        $scope.getCounts();
    });

    /**
     * get the count of all the recipes and fill it in!
     * @returns {undefined} nothing
     */
    $scope.getCounts = () => {
        countsProvider.getCounts().then((response) => {
            $scope.ingredientCount = response.ingredients || 0;
            $scope.recipesCount = response.recipes || 0;
            $scope.productCount = response.products || 0;
            $scope.userCount = response.users || 0;
            // $timeout(getCounts, 5000); // we could do so much here instead! (web sockets!)
        });
    };

    $scope.getUser = () =>
        userProvider.getUser().then((response) => {
            $scope.user = response;
            return $scope.user;
        });

    userProvider.setHeaderFromToken();
    $scope.getUser();
    $scope.getCounts();
});
