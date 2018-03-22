app.controller('ingredientsController', ($scope, ingredientProvider) => {
    $scope.ingredients = [];
    $scope.isAdminUser = false;

    ingredientProvider.getIngredients().then((res) => {
        $scope.ingredients = res;
    });

    $scope.purchaseIngredient = (ingredient, count = 1) => {
        const newCount = ingredient.stock + count;
        ingredientProvider.purchaseIngredient(ingredient.id, newCount).then((res) => {
            ingredient.stock = res.stock;
        });
    };

    $scope.setIngredientCount = (ingredient) => {
        if (ingredient.showInput) {
            ingredientProvider.purchaseIngredient(ingredient.id, ingredient.stock).then((res) => {
                ingredient.stock = res.stock;
                ingredient.showInput = false;
            });
        } else {
            ingredient.showInput = true;
        }
    };
    /**
     * set the isAdminUser to whether the current user has the ROLE_SUPER_ADMIN role
     * @returns {undefined} undefined
     */
    function checkAdmin() {
        $scope.isAdminUser = $scope.user && $scope.user.roles && ($scope.user.roles.indexOf('ROLE_SUPER_ADMIN') !== -1);
    }

    $scope.$on('userChanged', () => checkAdmin());

    if ($scope.user && $scope.user.roles) {
        checkAdmin();
    }
});
