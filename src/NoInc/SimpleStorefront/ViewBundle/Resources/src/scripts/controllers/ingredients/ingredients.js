app.controller('ingredientsController', ($scope, ingredientProvider) => {
    $scope.ingredients = [];
    $scope.isAdminUser = false;

    ingredientProvider.getIngredients().then((res) => {
        $scope.ingredients = res;
    });

    $scope.$on('userChanged', () => {
        $scope.isAdminUser = $scope.user && $scope.user.roles && ($scope.user.roles.indexOf('ROLE_ADMIN') !== -1);
    });

    $scope.purchaseIngredient = (ingredient, count = 1) => {
        const newCount = ingredient.stock + count
        ingredientProvider.purchaseIngredient(ingredient.id, newCount).then((res) => {
            console.info(res);
        });
    }
});
