app.controller('ingredientsController', ($scope, ingredientProvider, $mdPanel) => {
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

    $scope.setIngredientCount = (ingredient) => {
        if(ingredient.showInput){
            ingredientProvider.purchaseIngredient(ingredient.id, ingredient.stock).then((res) => {
                ingredient.stock = res.stock;
                ingredient.showInput = false;
            });
        } else {
            ingredient.showInput = true;
        }
    }

    function checkAdmin() {
        $scope.isAdminUser = $scope.user && $scope.user.roles && ($scope.user.roles.indexOf('ROLE_SUPER_ADMIN') !== -1);
    }

    if ($scope.user && $scope.user.roles) {
        checkAdmin();
    }
});
