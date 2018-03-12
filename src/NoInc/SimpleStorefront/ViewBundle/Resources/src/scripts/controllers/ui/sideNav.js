app.controller('sideNavController', ($scope, $mdSidenav, $timeout, countsProvider) => {
    $scope.recipeCount = 0;
    $scope.ingredientCount = 0;
    $scope.userCount = 0;
    $scope.productCount = 0;

    $scope.close = () => {
        $mdSidenav('left').close();
    };

    /**
     * get the count of all the recipes and fill it in!
     * @returns {undefined} nothing
     */
    function getCounts() {
        countsProvider.getCounts().then((response) => {
            $scope.ingredientCount = response.ingredients || 0;
            $scope.recipesCount = response.recipes || 0;
            $scope.productCount = response.products || 0;
            $scope.userCount = response.users || 0;
            $timeout(getCounts, 5000); // we could do so much here instead! (web sockets!)
        });
    }
    getCounts();
});
