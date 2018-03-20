app.controller('ingredientsController', ($scope, ingredientProvider) => {
    $scope.ingredients = [];

    ingredientProvider.getIngredients().then((res) => {
        $scope.ingredients = res;
    });

    $scope.purchaseIngredient = ingredientName =>
        ingredientProvider.purchaseIngredient(ingredientName).then((res) => {
            debugger;
            $scope.ingredients = res;
        });
});
