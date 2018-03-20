app.controller('ingredientsController', ($scope, ingredientProvider) => {
    $scope.ingredients = [];
    $scope.isAdminUser = false;

    ingredientProvider.getIngredients().then((res) => {
        $scope.ingredients = res;
    });

    $scope.$on('userChanged', () => checkAdmin());

    $scope.purchaseIngredient = (ingredient, count = 1) => {
        const newCount = ingredient.stock + count;
        ingredientProvider.purchaseIngredient(ingredient.id, newCount).then((res) => {
            ingredient.stock = res.stock;
        });
    };

    function checkAdmin() {
        $scope.isAdminUser = $scope.user && $scope.user.roles && ($scope.user.roles.indexOf('ROLE_SUPER_ADMIN') !== -1);
    }

    if ($scope.user && $scope.user.roles) {
        checkAdmin();
    }
});
