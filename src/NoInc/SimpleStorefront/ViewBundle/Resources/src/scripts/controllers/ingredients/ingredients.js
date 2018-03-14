app.controller('ingredientsController', ($scope, ingredientProvider) => {
    $scope.ingredients = [];

    ingredientProvider.getIngredients().then((res) => {
        $scope.ingredients = res;
    });
});
