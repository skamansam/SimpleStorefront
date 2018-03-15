app.controller('allRecipesController', ($scope, recipeProvider) => {
    $scope.recipes = [];
    $scope.ingredientsVisible = false;
    $scope.isAdminUser = false;
    // $scope.user = userProvider.getUser(); // not needed. is added to scope in the parent controller (sideNav)

    $scope.toggleIngredients = () => {
        $scope.ingredientsVisible = !$scope.ingredientsVisible;
    };
    $scope.$on('userChanged', () => {
        $scope.isAdminUser = $scope.user && $scope.user.roles && ($scope.user.roles.indexOf('ROLE_ADMIN') !== -1);
    });

    $scope.canMake = (recipe) => {
        let hasAllIngredients = true;
        recipe.forEach(recipe.ingredients, (ingredient) => {
            if (hasAllIngredients && ingredient.stock < 1) {
                hasAllIngredients = false;
            }
        });
    };

    recipeProvider.getRecipes().then((response) => {
        $scope.recipes = response;
    });
});
